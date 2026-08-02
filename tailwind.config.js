export default {
  content: ['./resources/**/*.blade.php', './resources/**/*.js'],
  theme: {
    extend: {
      colors: { green: { 900: '#0D493B', 700: '#28624F' }, beige: { 300: '#E9DDAE', 100: '#F1EBDD' }, gold: { 600: '#9B7C38' }, surface: '#F6F1E7', ink: '#17362E', muted: '#5D685F' },
      fontFamily: { display: ['Cormorant Garamond', 'Georgia', 'serif'], sans: ['Manrope', 'Arial', 'sans-serif'] },
      boxShadow: { soft: '0 12px 35px rgba(13,73,59,.08)' },
    },
  },
  plugins: [require('@tailwindcss/forms')],
};
