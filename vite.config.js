import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/pages/public.css",
                "resources/css/pages/dashboard.css",
                "resources/css/pages/auth.css",
                "resources/css/pages/app.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
