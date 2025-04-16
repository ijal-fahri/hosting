import React from "react";
import ReactDOM from "react-dom/client";
import "../css/app.css"; // Import Tailwind CSS

function App() {
    return (
        <div className="flex items-center justify-center min-h-screen bg-gray-100">
            <h1 className="text-4xl font-bold text-blue-500">Hello, Laravel + React + Tailwind!</h1>
        </div>
    );
}

ReactDOM.createRoot(document.getElementById("app")).render(<App />);
