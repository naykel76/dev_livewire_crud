import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import purge from '@erbelion/vite-plugin-laravel-purgecss'

export default defineConfig({
    plugins: [
        // if there are issues, try with laravel.default
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        },
        purge({
            paths: [
                'resources/views/**/*.blade.php',
                'vendor/naykel/**/resources/views/**/*.blade.php'
            ],
            safelist: {
                standard: [/^\:has$/, /^\:is$/, /^\:not$/, /^\:where$/, /^\:disabled$/],
                greedy: [/code$/, /hljs-/]
            },
            extractors: [
                {
                    extractor: (content) => {
                        return content.match(/[A-Za-z0-9-_:\/]+/g) || []
                    },
                    extensions: ['css', 'html', 'vue', 'php'],
                },
            ],
        })
    ],
});
