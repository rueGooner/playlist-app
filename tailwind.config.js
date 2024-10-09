import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import {blueGreens, icyBlues, myTheme} from "./resources/themes/theme.ts";

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
        sans: ['Advent Pro', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        ...myTheme
      }
    },
  },

  plugins: [forms],
};
