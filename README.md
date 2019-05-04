# Trabajamosremoto

Website trabajamosremoto.com

## Configuration

1. Rename .env.example to .env and configure variables.

2. Create database for development and testing in MySql:

    ```
    CREATE DATABASE trabajamosremoto;
    CREATE DATABASE trabajamosremoto_test;
    ```

3. Execute migrations:

    ```
    php artisan migrate
    ```
    
4. Execute server development:

    ```
    php artisan serve
    ```

## Testing

For run the tests:

    composer tests
