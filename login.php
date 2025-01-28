<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - SecureAuth Pro</title>
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
    <a href="index.php" 
       class="fixed top-4 left-4 p-3 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition duration-200 glass-effect">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    </a>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-4xl w-full mx-auto grid md:grid-cols-2 gap-8 items-center">
            <!-- Left Column - Animation -->
            <div class="hidden md:block">
                <lottie-player 
                    src="https://assets10.lottiefiles.com/packages/lf20_xvrofzfk.json"
                    background="transparent"
                    speed="1"
                    loop
                    autoplay>
                </lottie-player>
            </div>

            <!-- Right Column - Login Form -->
            <div class="hover-card glass-effect p-8 rounded-2xl">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Welcome Back!</h1>
                    <p class="text-gray-200">Login to access your secure dashboard</p>
                </div>

                <?php if (isset($error)): ?>
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative glass-effect" role="alert">
                        <span class="block sm:inline"><?php echo $error; ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="space-y-6">
                    <div>
                        <label class="block text-white text-sm font-semibold mb-2">Username</label>
                        <input type="text" 
                               name="username" 
                               required 
                               class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 focus:border-white focus:outline-none text-white placeholder-gray-300"
                               placeholder="Enter your username">
                    </div>
                    
                    <div>
                        <label class="block text-white text-sm font-semibold mb-2">Password</label>
                        <input type="password" 
                               name="password" 
                               required 
                               class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 focus:border-white focus:outline-none text-white placeholder-gray-300"
                               placeholder="Enter your password">
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-white text-indigo-600 py-3 px-4 rounded-lg font-semibold hover:bg-opacity-90 transform hover:scale-105 transition duration-200">
                        Login
                    </button>
                </form>

                <div class="mt-6 text-center space-y-2">
                    <p class="text-gray-300">
                        Don't have an account? 
                        <a href="register.php" class="text-white hover:underline font-semibold">Register here</a>
                    </p>
                    <a href="index.php" class="block text-gray-300 hover:text-white transition-colors duration-200">
                        ← Back to Home
                    </a>
                </div>

                <!-- Security Features -->
                <div class="mt-8 flex justify-center gap-4">
                    <span class="text-white text-opacity-80 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Secure Login
                    </span>
                    <span class="text-white text-opacity-80 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        Encrypted
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Shapes Background -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden -z-10">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white opacity-10 rounded-full mix-blend-overlay filter blur-xl animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-pink-400 opacity-10 rounded-full mix-blend-overlay filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 right-1/3 w-64 h-64 bg-yellow-300 opacity-10 rounded-full mix-blend-overlay filter blur-xl animate-blob animation-delay-4000"></div>
    </div>
</body>
</html> 