/** @type {import('tailwindcss').Config} */
module.exports = {
  corePlugins: {
    preflight: false,
  },
  content: [
    // "./**/*.{php,js}",
    "./includes/publics/templates/**/*.{php,js}",
  ],
  theme: {
    container: {
      center: true,
    },
    extend: {
      colors: {
        primary: "#3350E3",
        secondary: "#BFBBC9",
      
      },

      fontFamily: {
        sans: ["IRANSansx", "arial", "sans-serif"],
      },
      fontSize: {},
      boxShadow: {
      },
      dropShadow: {},
      borderRadius: {},
      backgroundImage: {},
      gridTemplateRows: {
        // Simple 8 row grid
      },
    },
  },

  plugins: [
    function ({ addVariant }) {
      addVariant("child", "& > *");
      addVariant("child-hover", "& > *:hover");
    },
    require("tailwindcss-labeled-groups")(["1", "2", "3", "4", "5", "6"]),
    ({ addUtilities }) => {
      addUtilities({
        ".tw-hidden": {
          display: "none",
        },
        ".flex-center": {
          display: "flex",
          "align-items": "center",
          "justify-content": "center",
        },
        ".tw-text-center": {
          "text-align": "center",
        },
        
      });
    },
  ],
};
