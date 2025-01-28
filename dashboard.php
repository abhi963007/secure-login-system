<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db_connect.php';

// Get user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, created_at FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - SecureAuth Pro</title>
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

        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
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
        <div class="max-w-4xl w-full mx-auto grid md:grid-cols-2 gap-8 items-start">
            <!-- Left Column - User Profile -->
            <div class="hover-card glass-effect p-8 rounded-2xl">
                <div class="text-center mb-8">
                    <div class="w-24 h-24 mx-auto bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">
                        Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                    </h1>
                    <p class="text-gray-200">Manage your account and settings</p>
                </div>

                <div class="space-y-4 text-white">
                    <div class="glass-effect rounded-lg p-4">
                        <p class="flex justify-between items-center">
                            <span class="text-gray-300">Username:</span>
                            <span class="font-semibold"><?php echo htmlspecialchars($user['username']); ?></span>
                        </p>
                    </div>
                    <div class="glass-effect rounded-lg p-4">
                        <p class="flex justify-between items-center">
                            <span class="text-gray-300">Email:</span>
                            <span class="font-semibold"><?php echo htmlspecialchars($user['email']); ?></span>
                        </p>
                    </div>
                    <div class="glass-effect rounded-lg p-4">
                        <p class="flex justify-between items-center">
                            <span class="text-gray-300">Member since:</span>
                            <span class="font-semibold"><?php echo date('F j, Y', strtotime($user['created_at'])); ?></span>
                        </p>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="logout.php" 
                       class="block w-full py-3 px-6 text-center bg-white text-indigo-600 rounded-xl hover:bg-opacity-90 transform hover:scale-105 transition duration-200 font-semibold shadow-lg">
                        Logout
                    </a>
                </div>
            </div>

            <!-- Right Column - Stats and Quick Actions -->
            <div class="space-y-6">
                <!-- Add Lottie Animation -->
                <div class="glass-effect p-6 rounded-2xl">
                    <lottie-player 
                        src="https://assets2.lottiefiles.com/packages/lf20_dews3j6m.json"
                        background="transparent"
                        speed="1"
                        style="width: 100%; height: 200px;"
                        loop
                        autoplay>
                    </lottie-player>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="stat-card glass-effect p-6 rounded-xl text-center">
                        <div class="text-3xl font-bold text-white mb-2">100%</div>
                        <div class="text-gray-200 text-sm">Security Score</div>
                    </div>
                    <div class="stat-card glass-effect p-6 rounded-xl text-center">
                        <div class="text-3xl font-bold text-white mb-2">Active</div>
                        <div class="text-gray-200 text-sm">Account Status</div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="hover-card glass-effect p-6 rounded-2xl">
                    <h3 class="text-xl font-semibold text-white mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="account_settings.php" 
                           class="block w-full p-3 glass-effect rounded-lg text-white text-left hover:bg-white hover:bg-opacity-10 transition duration-200">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Account Settings
                            </span>
                        </a>
                        <a href="security_settings.php" 
                           class="block w-full p-3 glass-effect rounded-lg text-white text-left hover:bg-white hover:bg-opacity-10 transition duration-200">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Security Settings
                            </span>
                        </a>
                    </div>
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