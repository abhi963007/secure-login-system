﻿# SecureAuth Pro - Secure Login System

A modern, secure authentication system built with PHP and MySQL, featuring a beautiful UI with Tailwind CSS.

## Features

- 🔒 Secure user authentication
- 📝 User registration with email
- 🔐 Password hashing with PHP's password_hash()
- 👤 User profile management
- 🛡️ Security settings with password change functionality
- 🎨 Modern UI with glass-morphism design
- 🌊 Smooth animations with Lottie
- 📱 Fully responsive design

## Technologies Used

- PHP 7.4+
- MySQL
- Tailwind CSS
- LottieFiles for animations
- HTML5
- Modern JavaScript

## Setup Instructions

1. Clone the repository:
```bash
git clone https://github.com/abhi963007/secure-login-system.git
```

2. Import the database schema:
```sql
CREATE DATABASE auth_system;
USE auth_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. Configure the database connection in `db_connect.php`:
```php
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "auth_system";
```

4. Place the files in your web server directory
5. Access the application through your web browser

## Security Features

- Password hashing using PHP's built-in password_hash() function
- Session-based authentication
- SQL injection prevention with prepared statements
- XSS protection
- CSRF protection
- Secure password reset functionality

## File Structure

- `index.php` - Landing page
- `register.php` - User registration
- `login.php` - User login
- `dashboard.php` - User dashboard
- `account_settings.php` - Profile management
- `security_settings.php` - Password management
- `logout.php` - Session termination
- `db_connect.php` - Database configuration

## Contributing

Feel free to fork this repository and submit pull requests for any improvements.
