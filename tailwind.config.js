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
            // from #EEF2FF through #6265F1 to #1D1A4B
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
            50: '#f9f9f9',
            100: '#f3f3f3',
            200: '#e0e0e0',
            300: '#cecece',
            400: '#ababab',
            500: '#888888',
            600: '#7a7a7a',
            700: '#666666',
            800: '#4d4d4d',
            900: '#404040',
          },
        },
      },
    },
  },
  plugins: [],
}
