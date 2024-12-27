import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
    plugins: [
        vue(),
        laravel([
            "resources/sass/app.scss",
            "resources/js/bootstrap.js",

            //Public Main
            'resources/public_assets/sass/app.scss',
            'resources/public_assets/js/app.js',

            // Partial Multiple Image/File
            "resources/admin_assets/js/partial/create.js",

            // Project
            "resources/admin_assets/js/project/index.js",
            "resources/admin_assets/js/project/create.js",

            // Gallery
            "resources/admin_assets/js/gallery/index.js",
            "resources/admin_assets/js/gallery/create.js",

            // Client & Partner
            "resources/admin_assets/js/client_partner/index.js",

            // Club
            "resources/admin_assets/js/club/index.js",

            // Website
            // Blog
            "resources/admin_assets/js/website/blog/index.js",
            "resources/admin_assets/js/website/blog/create.js",
            // Career
            "resources/admin_assets/js/website/career/index.js",
            // Event
            "resources/admin_assets/js/website/event/index.js",
            // News
            "resources/admin_assets/js/website/news/index.js",
            // FAQs
            "resources/admin_assets/js/website/faq/index.js",
            // Testimonial
            "resources/admin_assets/js/website/testimonial/index.js",

            // Asset
            "resources/admin_assets/js/asset/index.js",
            "resources/admin_assets/js/asset/create.js",
            // Asset Sale
            "resources/admin_assets/js/asset/sale_index.js",
            "resources/admin_assets/js/asset/sale_create.js",

            // Footprint
            // Activity Log
            "resources/admin_assets/js/logs/activity_log.js",
            // Login history
            "resources/admin_assets/js/logs/login_history.js",

            // Config Menu

            // Role
            "resources/admin_assets/js/config/role/index.js",
            // Dropdown
            "resources/admin_assets/js/config/dropdown/list.js",
            "resources/admin_assets/js/config/dropdown/index.js",
            // Pricing Plan
            "resources/admin_assets/js/config/pricing_plan/index.js",
            // Email Template
            "resources/admin_assets/js/config/email_template/index.js",

            // Bulk Email
            "resources/admin_assets/js/bulk_email/create.js",
            "resources/admin_assets/js/bulk_email/index.js",
            "resources/admin_assets/js/bulk_email/show.js",

            // Member
            "resources/admin_assets/js/member/index.js",

            //Team
            "resources/admin_assets/js/team/index.js",
            "resources/admin_assets/js/team/show.js",
        ]),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "@": "/resources/js",
        },
    },
    build: {
        rollupOptions: {
            output: {
                assetFileNames: (asset) => {
                    let typePath = "styles";
                    const type = asset.name.split(".").at(1);
                    if (/png|jpe?g|webp|svg|gif|tiff|bmp|ico/i.test(type)) {
                        typePath = "images";
                    }
                    return `${typePath}/[name]-[hash][extname]`;
                },
                chunkFileNames: "scripts/chunks/[name]-[hash].js",
                entryFileNames: "scripts/[name]-[hash].js",
            },
        },
    },
});
