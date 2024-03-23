import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@Components": path.resolve(__dirname, "resources/js/Components"),
            "@Pages": path.resolve(__dirname, "resources/js/Pages"),
        },
    },
    server: {
        host: "0.0.0.0",
        hmr: {
            host: "localhost",
        },
    },
});
