<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel JWT Authentication System with Real-time Notifications using Pusher

This project implements a JWT-based authentication system with Laravel. It also uses Pusher for real-time notifications when a new user registers. Additionally, it includes a seeder to create an initial admin and user, along with email verification, forgot password functionality, and time zone configuration.

## Requirements

- PHP 8.2
- Laravel 10
- Composer
- MySQL
- Node.js & npm
- Pusher account (for real-time notifications)

## Installation Steps

### 1. Clone the repository

```console
git clone https://github.com/kaziomarSH24/auth_system.git
cd auth_system
```

### 2. Install Composer
```console
composer install
```

### 3. Create the .env file
```console
cp .env.example .env
```




Update the `.env` file with the following:
#### Database configuration:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```


#### Pusher configuration:
```bash
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=your_pusher_app_cluster
BROADCAST_DRIVER=pusher
```

##### Email configuration:
Make sure to configure your email service for sending verification and password reset emails.
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=your-email@example.com
MAIL_FROM_NAME="${APP_NAME}"
```
##### Time zone configuration:
Set the application's time zone to `Asia/Dhaka` in your `.env` or `config/app.php`:
```bash
APP_TIMEZONE=Asia/Dhaka
```

### 4. Generate APP key
```console
php artisan key:generate
```

### 5. Set up JWT secret key
```console
php artisan jwt:secret
```
### 6. Run database migrations
```console
php artisan migrate
```

### 7.Seed the database
```console
php artisan db:seed
```

This will create two users:

- **Admin**: `admin@admin.com`, password: `12345678`
- **User**: `user@user.com`, password: `12345678`

### 8. Email Verification & Password Reset

- New users will receive a verification email after registration.
- Users can request a password reset link through their registered email.

Make sure to queue email verification and password reset emails by configuring your mail driver properly.

### 10. Run the application
```console
php artisan serve
```


# Usage Instructions
- Users can register, verify their email, and login using JWT-based authentication.
- Real-time admin notifications are sent via Pusher when a new user registers.
- Forgot password functionality is available with email-based password reset.
- Admins can view notifications without refreshing the page.

# Endpoints

- User registration: `/api/register`
- User login: `/api/login`
- Forgot password: `/api/forget-password`
- Reset password: `/api/reset-password`


# Additional Information

- For JWT token-based authentication, make sure to include the token in the `Authorization` header as `Bearer <token>`.
- You can check real-time notifications in the admin dashboard when new users register.
- The application’s time zone is set to `Asia/Dhaka`.
- Pusher is used for broadcasting real-time notifications with `BROADCAST_DRIVER=pusher`.
