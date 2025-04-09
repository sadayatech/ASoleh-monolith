import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import compression from 'vite-plugin-compression2';
import tailwind from '@tailwindcss/vite'
export default defineConfig({
    plugins: [
        tailwind(),
        laravel({
            input: "resources/js/app.js",
            ssr: "resources/js/ssr.js",
            refresh: true,
        }),
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
    build: { cssMinify: true, minify: true },
    esbuild: true,
    optimizeDeps: {
        esbuildOptions: { minifyWhitespace: true, minify: true, minifyIdentifiers: true, minifySyntax: true, legalComments: "none" },
    },

});