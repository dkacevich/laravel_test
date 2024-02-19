import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        https: false,
        host: '0.0.0.0',
        port: '8080',
        hmr: {
            host: 'vite.dvl.to',
            clientPort: '80',
            protocol: 'ws',
            https: false,
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
