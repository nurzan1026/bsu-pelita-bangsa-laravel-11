/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            padding: "24px",
            center: true,
        },
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
                Quicksand: ["Quicksand", "sans-serif"],
                roboto: ["Roboto", "sans-serif"],
                caveat: ["Caveat", "sans-serif"],
            },
            colors: {
                primary: "#047857",
                hijau: "#1B8E5F",
                hitam: "#1f2937",
                biru: "#0891b2",
            },
            animation: {
                "spin-slow": "spin 3s linear infinite",
                "ping-slow": "ping 2s linear infinite",
                goyang: "goyang 1s ease-in-out infinite",
            },
            keyframes: {
                goyang: {
                    "0%, 100%": { transform: "rotate(-3deg)" },
                    "50%": { transform: "rotate(3deg)" },
                },
            },
        },
    },
    plugins: [],
};
