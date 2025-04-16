import React, { useState } from "react";
import axios from "axios";

const Login = () => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [message, setMessage] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post("/api/login", { email, password });
            setMessage("Login successful!");
            localStorage.setItem("token", response.data.token); // Simpan token
        } catch (error) {
            setMessage("Invalid credentials. Please try again.");
        }
    };

    return (
        <div className="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
            <h1 className="text-2xl font-bold text-center mb-4">Login</h1>
            {message && <p className="text-center text-red-500">{message}</p>}
            <form onSubmit={handleSubmit}>
                <div className="mb-4">
                    <label className="block">Email</label>
                    <input
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        className="w-full border rounded p-2"
                        required
                    />
                </div>
                <div className="mb-4">
                    <label className="block">Password</label>
                    <input
                        type="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        className="w-full border rounded p-2"
                        required
                    />
                </div>
                <button
                    type="submit"
                    className="w-full bg-blue-500 text-white p-2 rounded"
                >
                    Login
                </button>
            </form>
        </div>
    );
};

export default Login;
