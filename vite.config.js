import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import '../css/app.css';
// Importa otros scripts o estilos aquí


import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [laravel()],
    css: {
        postcss: './postcss.config.cjs',
    },
    build: {
        rollupOptions: {
            input: 'resources/js/app.js', // Este es tu archivo de entrada real
        },
    },
})

