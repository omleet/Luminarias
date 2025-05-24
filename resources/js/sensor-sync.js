// ========== Configuration ==========
const ESP_IP = '192.168.1.100';
const UPDATE_INTERVAL = 2000;

// ========== Helpers ==========
function analogToLux(analogValue) {
    const inverted = 1024 - analogValue;
    return Math.round((inverted / 1024) * 1000);
}

async function fetchJson(path, opts = {}) {
    const res = await fetch(`http://${ESP_IP}${path}`, opts);
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    return res.json();
}

async function fetchLedState() {
    const data = await fetchJson('/status');
    return data.led;
}

async function fetchLightLevel() {
    const data = await fetchJson('/light');
    return {
        analog: data.light,
        lux: analogToLux(data.light)
    };
}

async function fetchTemperatureHumidity() {
    return await fetchJson('/temperature');
}

async function fetchMotionRaw() {
    const data = await fetchJson('/motion');
    return data.motion;
}

async function controlLed(state) {
    await fetch(`http://${ESP_IP}/led/${state}`, { method: 'POST' });
}

async function setLedBrightness(value) {
    try {
        await fetch(`http://${ESP_IP}/led/brightness?value=${value}`, {
            method: 'POST'
        });
    } catch (err) {
        console.error('Erro ao ajustar brilho:', err);
    }
}

async function uploadToDatabase(lux, temperature, ledState, motion, humidity) {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!token) return;
    try {
        await fetch('/history', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ light: lux, temperature, led_state: ledState, motion, humidity })
        });
    } catch (err) {
        console.error("DB upload failed:", err);
    }
}

// ========== DOM Display Updates ==========
function updateLedDisplay(status) {
    const el = document.getElementById('led-status');
    const ledOn = document.getElementById('led-on');
    const ledOff = document.getElementById('led-off');
    if (!el || !ledOn || !ledOff) return;

    el.textContent = status;
    if (status === 'ON') {
        ledOn.classList.remove('hidden');
        ledOff.classList.add('hidden');
        el.closest('.bg-white')?.classList.add('ring-2', 'ring-green-500');
    } else {
        ledOn.classList.add('hidden');
        ledOff.classList.remove('hidden');
        el.closest('.bg-white')?.classList.remove('ring-2', 'ring-green-500');
    }
}

function updateMotionDisplay(active) {
    const el = document.getElementById('movement-status');
    const activeBadge = document.getElementById('movement-active');
    const inactiveBadge = document.getElementById('movement-inactive');
    const container = el?.closest('.bg-white');
    if (!el || !activeBadge || !inactiveBadge || !container) return;

    el.textContent = active ? 'Ligado' : 'Inativo';
    activeBadge.classList.toggle('hidden', !active);
    inactiveBadge.classList.toggle('hidden', active);
    container.classList.toggle('ring-2', active);
    container.classList.toggle('ring-green-500', active);
}

function updateSensorValues(lux, temp, humidity) {
    const luxEl = document.getElementById('light-value');
    const tempEl = document.getElementById('temperature-value');
    const humEl = document.getElementById('humidity-value');

    if (luxEl) luxEl.textContent = `${lux} lx`;
    if (tempEl) tempEl.textContent = `${temp} °C`;
    if (humEl) humEl.textContent = `${humidity} %`;
}



// ========== State Getters ==========
function getSensorState(sensorKey, defaultValue = false) {
    const stored = localStorage.getItem(sensorKey);
    if (stored === null) return defaultValue;
    return stored === 'true';
}

function saveSensorStateFromDOM(id, key) {
    const el = document.getElementById(id);
    if (el) {
        localStorage.setItem(key, el.checked ? 'true' : 'false');
    }
}

// ========== Main Polling Loop ==========
document.addEventListener('DOMContentLoaded', () => {
    // Atualiza o localStorage caso o utilizador mude os toggles (na página controlos)
    const sensorIds = [
        ['motion-sensor-toggle', 'motionSensorEnabled'],
        ['light-sensor-toggle', 'lightSensorEnabled'],
        ['temperature-sensor-toggle', 'temperatureSensorEnabled'],
        ['humidity-sensor-toggle', 'humiditySensorEnabled']
    ];

    sensorIds.forEach(([domId, key]) => {
        const el = document.getElementById(domId);
        if (el) {
            // Sincronizar toggle inicial com o localStorage
            el.checked = getSensorState(key, true);
            el.addEventListener('change', () => {
                localStorage.setItem(key, el.checked ? 'true' : 'false');
            });
        }
    });

    // Se não existir, define autoControl como ativo
    if (localStorage.getItem('autoControlEnabled') === null) {
        localStorage.setItem('autoControlEnabled', 'true');
    }

    setInterval(async () => {
        const autoControlEnabled = localStorage.getItem('autoControlEnabled') === 'true';

        // Ler estado atual dos sensores do localStorage
        const motionEnabled = getSensorState('motionSensorEnabled', true);
        const lightEnabled = getSensorState('lightSensorEnabled', true);
        const tempEnabled = getSensorState('temperatureSensorEnabled', true);
        const humidityEnabled = getSensorState('humiditySensorEnabled', true);

        try {
            const [ledState, lightData, tempHum, rawMotion] = await Promise.all([
                fetchLedState(),
                lightEnabled || autoControlEnabled ? fetchLightLevel() : Promise.resolve({ analog: 0, lux: 0 }),
                tempEnabled || humidityEnabled || autoControlEnabled ? fetchTemperatureHumidity() : Promise.resolve({ temperature: 0, humidity: 0 }),
                motionEnabled || autoControlEnabled ? fetchMotionRaw() : Promise.resolve(0)
            ]);

            if (autoControlEnabled) {
                if (lightData.lux < 150) {
                    if (rawMotion) {
                        // Motion detected: full brightness
                        await setLedBrightness(255);
                    } else {
                        // No motion: dim mode
                        await setLedBrightness(128);
                    }
                } else {
                    // Light is sufficient: turn off LED
                    await setLedBrightness(0);
                }
            }

            await uploadToDatabase(
                lightData.lux,
                tempHum.temperature,
                ledState,
                rawMotion,
                tempHum.humidity
            );

            // Só atualiza DOM se existir (ex: dashboard pode não ter todos)
            if (document.getElementById('temperature-value')) {
                updateLedDisplay(ledState);
                updateMotionDisplay(motionEnabled || autoControlEnabled ? rawMotion : 0);
                updateSensorValues(
                    lightEnabled || autoControlEnabled ? lightData.lux : 0,
                    tempEnabled || autoControlEnabled ? tempHum.temperature : 0,
                    humidityEnabled || autoControlEnabled ? tempHum.humidity : 0
                );
            }

        } catch (err) {
            console.error('Sensor polling error:', err);
        }
    }, UPDATE_INTERVAL);
});
