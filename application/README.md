## About Laravel

## Learning Laravel

## Laravel Sponsors

### Premium Partners


# Laravel Application Setup Guide

This guide is help you to set the Laravel application on your local machine.

## Prerequisites

Before you begin, make sure you have the following installed on your system:

- PHP (>= 7.4)
- Composer
- MySQL 

## Installation Steps

1. **Clone the repository:**

    ```
    git clone https://github.com/rsrahul7838/Laravel-Assignment.git

    ```

2. **Install Composer dependencies:**

    ```
    composer install

    ```

3. **Create a `.env` file:**

    ```
    copy .env.example to .env 
    ```

    And Update the `.env` file with your database credentials and other configuration settings.

4. **Generate an application key:**

    ```
    php artisan key:generate
    ```

5. **Run migrations and seeders (if any):**

    ```
    php artisan migrate --seed
    ```

6. **Install npm dependencies:**

    ```
    npm install
    ```

    or if you prefer yarn:

    ```
    yarn install
    ```

7. **Compile assets (if any):**

    ```
    npm run dev
    ```

    or for production:

    ```
    npm run prod
    ```

8. **Serve the application:**

    ```
    php artisan serve
    ```

    This will start a development server at `http://localhost:8000`.

## Additional Steps

- **Set file permissions:** Make sure that the `storage` and `bootstrap/cache` directories are writable by your web server.
- **Configure your web server:** If you're not using the built-in development server, configure your web server to serve the application from the public directory.

## Contributing

If you encounter any issues or have suggestions for improvements, feel free to open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

