import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [ 'resources/js/main.js', 'resources/sass/page-styles/main-styles.scss'],
            refresh: true,
        }),
        /*tailwindcss(),*/
    ],
});
