/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./templates/**/*.html.twig",
    "./assets/**/*.{js,jsx,ts,tsx,vue}"
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          light: '#f5f5f5',
          DEFAULT: '#1f2937',
          dark: '#111827',
        },
      },
      animation: {
        'slide-in': 'slideIn 0.2s ease-out',
        'pop-up': 'popUp 0.3s ease-out forwards',
      },
      keyframes: {
        slideIn: {
          '0%': { transform: 'translateY(-10px)', opacity: 0 },
          '100%': { transform: 'translateY(0)', opacity: 1 },
        },
        popUp: {
          '0%': { transform: 'translate(-50%, 20px)', opacity: 0 },
          '100%': { transform: 'translate(-50%, 0)', opacity: 1 },
        },
      },
    },
  },
  plugins: [
		require('@tailwindcss/forms'),
		require('@tailwindcss/typography'),
	],
};
