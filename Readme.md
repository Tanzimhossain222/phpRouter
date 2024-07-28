
# Simple PHP Router

A lightweight PHP routing system for handling HTTP requests and mapping them to specific controller actions or callback functions.

## Installation

1. Clone the repository to your local machine:

    ```bash
    git clone https://github.com/Tanzimhossain222/phpRouter
    cd phpRouter
    ```

2. Ensure you have PHP installed on your machine. You can verify the installation by running:

    ```bash
    php -v
    ```

3. Start the built-in PHP server:

    ```bash
    php -S localhost:8080
    ```

## Project Structure

- `index.php`: Main entry point for the application.
- `routes.php`: Defines the routes for the application.
- `Router.php`: Contains the Router class to handle the routing logic.
- `APP/Controllers/PriceController.php`: Example controller to handle price-related requests.

## Example Routes

Define your routes in `routes.php`:

```php
require "Router.php";
use APP\Controllers\PriceController;
use APP\Routing\Router;

Router::get('/', function () {
    echo "Welcome to the homepage!";
});

Router::get('/hello', function () {
    echo "Hello, World! This is the /hello page.";
});

Router::get('/price', [PriceController::class, "showPrice"]);

Router::get('/price2', "PriceController@showPrice");

Router::cleanup();
```

## License

This project is licensed under the MIT License.
