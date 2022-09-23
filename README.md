# Stock Manager Project

This is the main repo of the stock manager.

## Table of contents

- [Setup in local development](#setup-in-local-development)
    - [Requirements](#requirements)
    - [Installation](#installation)
- [Code analysis](#code-analysis)
    - [All code analysis](#all-code-analysis)
- [Code explanation](#code-explanation)

## Setup in local development

### Requirements

- [Docker repository](https://github.com/PerezRaul/docker/tree/stock-manager) ( `stock-manager` branch )

### Installation
1. Add `127.0.0.1 stock-manager.localhost` on `/etc/hosts`.
2. Clone repository inside `~/Sites`:
3. Copy the file **.env.example** to **.env**.
    ```shell
    > cp .env.example .env
    ```
4. Go inside the workspace with the following command:
    ```shell
    > dockerbash
    ```
5. Execute the following commands on stock manager folder _/var/www/stock-manager_:
    ```shell
    > composer install
    > php artisan migrate:fresh --seed
    > npm install
    ```

## Code analysis

### All code analysis

```shell
> sh analysis.sh
```

## Code Explanation
### */app/Http/Controllers*
Path where we find the controllers to the routes of the endpoints that we have configured.

### */app/Http/Requests*
Path where we find the rules of the form requests of each controller.

### */app/Http/Providers*
Path where we find providers that we want to inject in the project.

### */config/shared/ioc.php*
Path where we are going to resolve the dependencies. For example when calling ProductRepository the dependency will be EloquentProductRepository (because we use eloquent in this project).

### */database*
Path where we are going to find the migrations and seeders of the database.

### */etc*
Route where we are going to find the endpoints that we can execute to collect the data. We can run them through PHPStorm with the `HTTP Client` plugin. Or we can run the following curl calls through Postman.
```shell
# Get all products in the database
curl -X GET --location "http://stock-manager.localhost/products" \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d "{
            \"per_page\": 20,
            \"page\": 1
        }"

# Put product with new uuid
curl -X PUT --location "http://stock-manager.localhost/products/8e31421d-79ec-4349-8604-c1657221feb6" \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d "{
            \"name\": \"PENDIENTE INDIVIDUAL LYN\"
        }"

# Get product by uuid in the database
curl -X GET --location "http://stock-manager.localhost/products/8e31421d-79ec-4349-8604-c1657221feb6" \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d "{
            \"per_page\": 20,
            \"page\": 1
        }"

# Get stock movements of product by uuid
curl -X GET --location "http://stock-manager.localhost/movements" \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d "{
            \"product_id\": \"8e31421d-79ec-4349-8604-c1657221feb6\",
            \"per_page\": 20,
            \"page\": 1
        }"
    
# Put stock movement of product by product uuid
curl -X PUT --location "http://stock-manager.localhost/movements/3e9b8c3f-ab4b-4ea7-b69f-97ceda77341b" \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d "{
            \"product_id\": \"8e31421d-79ec-4349-8604-c1657221feb6\",
            \"type\": \"add_stock\",
            \"amount\": 4
        }"
```

### */routes/web.php*
Path where we find the application routes.

### */src/Shared*
Path where we find the code structure that can be shared between other modules.

### */src/Products*
Path where we find the code structure of the initial project. Where the valueobjects of the tasks are generated, the queries with the database, the repository....
