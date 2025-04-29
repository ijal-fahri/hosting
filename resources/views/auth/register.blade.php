<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        fadeIn: "fadeIn 1s ease-in-out",
                    },
                    keyframes: {
                        fadeIn: {
                            "0%": { opacity: "0", transform: "translateY(-20px)" },
                            "100%": { opacity: "1", transform: "translateY(0)" },
                        },
                    },
                },
            },
        };
    </script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen w-full">
    <div class="bg-white shadow-md rounded-lg flex flex-col md:flex-row w-full max-w-5xl h-screen overflow-hidden">
        
        <!-- Bagian Form -->
        <div class="md:w-1/2 w-full p-6 md:p-12 flex flex-col justify-center animate-fadeIn">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-center md:text-left">Sign Up</h2>
            <p class="text-lg mb-4 text-center md:text-left">If you already have an account, <a href="{{ route('login') }}" class="text-blue-500 font-bold">Login here!</a></p>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-lg font-medium mb-2">Name</label>
                    <div class="flex items-center border-b border-gray-300 py-3 transition-all duration-300 focus-within:border-blue-500 hover:shadow-lg">
                        <i class="fas fa-user text-gray-500 mr-3"></i>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Enter your name"
                            class="w-full bg-transparent outline-none"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-lg font-medium mb-2">Email</label>
                    <div class="flex items-center border-b border-gray-300 py-3 transition-all duration-300 focus-within:border-blue-500 hover:shadow-lg">
                        <i class="fas fa-envelope text-gray-500 mr-3"></i>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="Enter your email"
                            class="w-full bg-transparent outline-none"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-lg font-medium mb-2">Password</label>
                    <div class="flex items-center border-b border-gray-300 py-3 transition-all duration-300 focus-within:border-blue-500 hover:shadow-lg">
                        <i class="fas fa-lock text-gray-500 mr-3"></i>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Enter your password"
                            class="w-full bg-transparent outline-none"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-lg font-medium mb-2">Confirm Password</label>
                    <div class="flex items-center border-b border-gray-300 py-3 transition-all duration-300 focus-within:border-blue-500 hover:shadow-lg">
                        <i class="fas fa-lock text-gray-500 mr-3"></i>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                            class="w-full bg-transparent outline-none"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
                </div>

                <button
                    type="submit"
                    class="w-full bg-black text-white py-3 text-lg rounded-full shadow-md hover:bg-gray-800 focus:outline-none transition-all duration-300 transform hover:scale-105"
                >
                    Register
                </button>
            </form>

            <div class="flex justify-center mt-6 space-x-6 text-2xl">
                <a href="#" class="text-blue-500 transition-transform transform hover:scale-125"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-red-500 transition-transform transform hover:scale-125"><i class="fab fa-google"></i></a>
            </div>
        </div>

        <!-- Bagian Video / Banner -->
        <div class="md:w-1/2 w-full relative bg-black text-white flex items-center justify-center animate-fadeIn overflow-hidden">
            <video autoplay loop muted class="w-full h-full object-cover">
                <source src="{{ asset('assets/register.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center p-6">
                <h2 class="text-4xl md:text-5xl font-bold">Join Us Today</h2>
                <p class="mt-2 text-lg md:text-xl">Start your journey now</p>
            </div>
        </div>

    </div>
</body>
</html>
