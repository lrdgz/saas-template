/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.ts",
        "./resources/**/*.vue",
        "./frontend/**/*.js",
        "./frontend/**/*.ts",
        "./frontend/**/*.vue",
    ],
  theme: {
    extend: {
        container: {
            center: true
        }
    },
  },
  plugins: [],
}
