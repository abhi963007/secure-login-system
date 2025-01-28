<!DOCTYPE html>
<html>
<head>
    <title>Welcome - Authentication System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .gradient-background {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .hover-card {
            transition: all 0.3s ease;
        }
        
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="gradient-background min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-4xl w-full mx-auto grid md:grid-cols-2 gap-8 items-center">
            <!-- Left Column - Animation -->
            <div class="hidden md:block">
                <lottie-player 
                    src="https://assets2.lottiefiles.com/packages/lf20_jcikwtux.json"
                    background="transparent"
                    speed="1"
                    loop
                    autoplay>
                </lottie-player>
            </div>

            <!-- Right Column - Content -->
            <div class="hover-card glass-effect p-8 rounded-2xl">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-white mb-4">
                        Welcome to 
                        <span class="block text-white">
                            SecureAuth Pro
                        </span>
                    </h1>
                    
                    <p class="text-gray-100 text-lg mb-8 leading-relaxed">
                        Experience secure authentication with our modern, reliable system.
                    </p>

                    <div class="space-y-4">
                        <a href="login.php" 
                           class="block w-full py-3 px-6 text-center bg-white text-indigo-600 rounded-xl hover:bg-opacity-90 transform hover:scale-105 transition duration-200 font-semibold shadow-lg">
                            Login to Your Account
                        </a>
                        
                        <a href="register.php" 
                           class="block w-full py-3 px-6 text-center bg-transparent border-2 border-white text-white rounded-xl hover:bg-white hover:text-indigo-600 transform hover:scale-105 transition duration-200 font-semibold">
                            Create New Account
                        </a>
                    </div>

                    <div class="mt-8 text-sm text-gray-300">
                        <p>Secure • Fast • Reliable</p>
                    </div>

                    <!-- Feature Pills -->
                    <div class="flex flex-wrap justify-center gap-2 mt-6">
                        <span class="px-3 py-1 bg-white bg-opacity-20 rounded-full text-xs text-white">
                            🔒 256-bit Encryption
                        </span>
                        <span class="px-3 py-1 bg-white bg-opacity-20 rounded-full text-xs text-white">
                            ⚡ Fast Performance
                        </span>
                        <span class="px-3 py-1 bg-white bg-opacity-20 rounded-full text-xs text-white">
                            🛡️ Advanced Security
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Shapes (Background Details) -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden -z-10">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white opacity-10 rounded-full mix-blend-overlay filter blur-xl animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-pink-400 opacity-10 rounded-full mix-blend-overlay filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 right-1/3 w-64 h-64 bg-yellow-300 opacity-10 rounded-full mix-blend-overlay filter blur-xl animate-blob animation-delay-4000"></div>
    </div>
</body>
</html> 