const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  variants: {
    opacity: ['responsive', 'hover', 'focus', 'disabled', 'group-hover', 'group-focus'],
  },
  plugins: [
    require('@tailwindcss/ui'),
    require('tailwindcss-interaction-variants'),
  ]
}
