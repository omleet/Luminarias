import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";


export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        host: '0.0.0.0',           // Listen on all interfaces
        port: 5174,                // Or whatever you're using
        strictPort: true,
        cors: {
          origin: '*',             // Allow all origins (or specify one)
          methods: ['GET', 'POST'],
          allowedHeaders: ['Content-Type'],
        },
        hmr: {
          host: '192.168.1.81',    // Your main dev PC's local IP
        }
      },
      
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
});
