import { defineConfig } from "vite";
import path from "path";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import compression from 'vite-plugin-compression2';
import tailwind from '@tailwindcss/vite'
export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
            refresh: true,
        }),
        tailwind(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
                compilerOptions: {
                    comments: false,
                    runtimeGlobalName: "Laravel",
                    optimizeImports: true,
                },
            },
        }),
        compression({
            algorithm: 'gzip', exclude: [/\.(br)$ /, /\.(gz)$/]
        }),
        compression({
            algorithm: 'brotliCompress', exclude: [/\.(br)$ /, /\.(gz)$/],
        }),
    ],
    build: {
        cssMinify: true,
        minify: true,
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        if (id.includes('vue')) return 'vue'
                        if (id.includes('axios')) return 'axios'
                        if (id.includes('vue3-apexcharts')) return 'vue3_apexcharts'
                        if (!(id.includes('vue3-apexcharts')) && id.includes('apexcharts')) return 'apexcharts'
                        return 'vendor'
                    } 
                },
            },
        },
        chunkSizeWarningLimit: 3000, // opsional, supaya gak terlalu sering warning
    },
    server: {
        watch: {
            usePolling: true,
            interval: 10000,
            ignored: ['node_modules', 'public', 'storage', 'vendor', 'resources/js/app.js', 'app']
        },
    },
    esbuild: true,
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
    optimizeDeps: {
        esbuildOptions: { minifyWhitespace: true, minify: true, minifyIdentifiers: true, minifySyntax: true, legalComments: "none" },
    },
});