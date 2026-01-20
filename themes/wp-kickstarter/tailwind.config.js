/** @type {import('tailwindcss').Config} */
export default {
  content: ['./**/*.php'],
  theme: {
    container: {
      center: true,
      padding: '1rem',
      screens: {
        sm: '640px',
        md: '768px',
        lg: '1024px',
        xl: '1280px',
        '2xl': '1400px',
      },
    },
    extend: {
      colors: {
        primary: {
          DEFAULT: '#3A1E5E',
          hover: '#553185', // Lighter purple for hover
        },
        secondary: '#10B981', 
        accent: '#F59E0B',
        dark: '#323232',
        light: '#F2F0F4',
        text: '#333333',
      },
      spacing: {
        'section': '80px',
        'block': '40px',
      },
    },
  },
}