import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import {birdsBerries, blueGreens, myTheme} from "./resources/themes/theme";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Livvic', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        ...myTheme
      }
    },
  },

  plugins: [forms],
};
