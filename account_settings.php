<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db_connect.php';

$user_id = $_SESSION['user_id'];
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Update user information
    $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['username'] = $username;
        $success_message = "Profile updated successfully!";
    } else {
        $error_message = "Failed to update profile.";
    }
}

// Get current user data
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Settings - SecureAuth Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="max-w-xl w-full">
            <div class="glass-effect p-8 rounded-2xl">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Account Settings</h1>
                    <p class="text-gray-200">Update your profile information</p>
                </div>

                <?php if ($success_message): ?>
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="space-y-6">
                    <div>
                        <label class="block text-white text-sm font-semibold mb-2">Username</label>
                        <input type="text" 
                               name="username" 
                               value="<?php echo htmlspecialchars($user['username']); ?>"
                               required 
                               class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 focus:border-white focus:outline-none text-white placeholder-gray-300">
                    </div>
                    
                    <div>
                        <label class="block text-white text-sm font-semibold mb-2">Email</label>
                        <input type="email" 
                               name="email" 
                               value="<?php echo htmlspecialchars($user['email']); ?>"
                               required 
                               class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-white border-opacity-30 focus:border-white focus:outline-none text-white placeholder-gray-300">
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-white text-indigo-600 py-3 px-4 rounded-lg font-semibold hover:bg-opacity-90 transform hover:scale-105 transition duration-200">
                        Save Changes
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="dashboard.php" 
                       class="text-gray-300 hover:text-white transition-colors duration-200">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 