<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Product Admin Panel

The **Product Admin Panel** is a Laravel-powered admin interface designed for effortless product management, order
tracking, and inventory control.

**Key Features:**

- **Product Management:** Add, edit, and delete products with ease.

**Why Choose Us?**

Our admin panel simplifies product management, streamlines order processing, and ensures a seamless user experience.

## Getting Started

To quickly set up and start using the **Product Admin Panel**, follow these steps:

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/maxim2513/skelar-test-admin.git
   ```

2. **Copy the Environment Configuration**

   ```bash
   cp .env.example .env
   ```
   Create a local .env file based on the provided .env.example. You may need to configure your environment variables in
   this file.

3. **Build and Start the Application**

   ```bash
   chmod +x start.sh
    ./start.sh
   ```
   Run the start.sh script to build and start the application using Laravel Sail with Docker.

4**Run PHPUnit for Testing**

   ```bash
   ./vendor/bin/sail test
   ```
Execute PHPUnit tests to ensure everything is working correctly.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
