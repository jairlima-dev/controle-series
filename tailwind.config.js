module.exports = {
  purge: [
      './resources/**/*.html',
      './resources/**/*.vue',
      './resources/**/*.js'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        spacing: {
            '72': '18rem',
            '84': '21rem',
            '96': '24rem',
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}

