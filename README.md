# Laravel Project

## Overview

This is a Laravel-based web application. It includes features like product management, stock movements, and reporting.

## Features

- **Product Management**: Create, update, delete, and view products.
- **Stock Movement**: Track stock movements, including incoming and outgoing stock.
- **Reporting**: Filter stock movements by date and product.

## Installation


1. Install dependencies:
    composer install

2. Copy the `.env.example` file to `.env`:

3. Generate the application key:
    php artisan key:generate

4. Set up your MYSQL database configuration in `.env` (database, username, password).

5. Run the migrations to create the necessary tables:
    php artisan migrate 

6. Serve the application:
    php artisan serve

9. Access the app in your browser: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## API Documentation

### Products API

- `GET /api/products`: Get all products.
- `GET /api/products/{id}`: Get a product by ID.
- `POST /api/products`: Create a new product.
- `PUT /api/products/{id}`: Update an existing product.
- `DELETE /api/products/{id}`: Delete a product.

### Stock Movements API

- `GET /api/stock-movements`: Get all stock movements.
- `GET /api/stock-movements/{id}`: Get a stock movement by ID.
- `POST /api/stock-movements`: Create a new stock movement.
