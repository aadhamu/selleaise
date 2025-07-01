import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command, mode }) => {
  return {
    plugins: [
      laravel({
        input: [
          'resources/sass/app.scss',
          'resources/js/app.js',
        ],
        refresh: true,
      }),
    ],
    // Force HTTPS in production for asset URLs
    server: {
      https: mode === 'production',
    },
    // Base path for production, set to your domain with https
    base: mode === 'production' ? 'https://sellease.onrender.com/' : '/',
  };
});
