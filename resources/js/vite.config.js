// vite.config.js

export default {
  build: {
    rollupOptions: {
      input: {
        main: 'resources/js/app.js', // メインのエントリーファイル
      },
    },
  },
};
