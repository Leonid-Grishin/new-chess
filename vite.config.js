import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/page-styles/main.scss', 'resources/sass/page-styles/school.scss', 'resources/sass/page-styles/camp.scss', 'resources/sass/page-styles/404.scss', 'resources/sass/page-styles/book-component.scss', 'resources/js/main.js'],
            refresh: true,
        }),
        /*tailwindcss(),*/
    ],
});
