import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

// Setup do Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Criação da app Vue
const app = createApp({});

// Registo global do componente Vue
app.component('example-component', ExampleComponent);

// Montar a app no elemento com id "app"
app.mount('#app');
