module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        kula: {
          light: {
            50: '#eef2ff',
            100: '#e0e5ff',
            200: '#c7ceff',
            300: '#aeb7ff',
            400: '#7d8eff',
            500: '#4c65ff',
            600: '#445bff',
            700: '#3a50f1',
            800: '#303ce0',
            900: '#1d1a4b',
            950: '#1a1744',
          },
          dark: {
            50: '#1a1744',
            100: '#1d1a4b',
            200: '#303ce0',
            300: '#3a50f1',
            400: '#445bff',
            500: '#4c65ff',
            600: '#7d8eff',
            700: '#aeb7ff',
            800: '#c7ceff',
            900: '#e0e5ff',
            950: '#eef2ff',
          },
        },
      },
    },
  },
  plugins: [],
}
