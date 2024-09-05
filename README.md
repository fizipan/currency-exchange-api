# Laravel Sail Setup (macOS & Windows)

This guide will walk you through the steps to set up and run a Laravel project using Sail on both macOS and Windows.

## Prerequisites

1. **Docker**: Make sure Docker is installed and running on your machine.

    - [Docker Desktop for macOS](https://www.docker.com/products/docker-desktop)
    - [Docker Desktop for Windows](https://www.docker.com/products/docker-desktop)

2. **Composer**: You will need Composer to install the dependencies.

    - [Download Composer](https://getcomposer.org/download/)

3. **Windows Users**: For Windows, it's recommended to use **WSL2** to run Laravel Sail.
    - [WSL2 Installation Guide](https://docs.microsoft.com/en-us/windows/wsl/install)

---

## Steps to Run the Project Locally

### 1. Clone the Repository

First, clone the project repository to your local machine:

```bash
git clone https://github.com/hafizhmaula/currency-exchange-api.git
cd currency-exchange-api
```

### 2. Install Dependencies with Composer

Run the following command to install the project dependencies using Composer:

```bash
composer install
```

> **Windows Users**: Make sure to run this inside your WSL2 environment.

### 3. Set Up the Environment File

-   Copy the `.env.example` file to create your `.env` file:

```bash
cp .env.example .env
```

-   Open the `.env` file and update the necessary environment variables, especially for database connections.

Example `.env` configuration:

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:generated-key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_currency_exchange
DB_USERNAME=sail
DB_PASSWORD=password

# Other configurations...
```

### 4. Generate the Application Key

Generate the application key by running the following command:

```bash
php artisan key:generate
```

### 5. Generate JWT Secret Key

Generate the JWT secret key by running the following command:

```bash
php artisan jwt:secret
```

### 6. Start Docker and Run Laravel Sail

To start the application with Sail, run the following command:

```bash
./vendor/bin/sail up -d
```

<!-- open to wsl and running -->

> **Windows Users**: Make sure to run this command inside your WSL2 environment.
>
> ```bash
> wsl
> ```

> ```bash
> ./vendor/bin/sail up -d
> ```

This command will start Docker containers for your Laravel application, including the web server and database.

### 7. Running Migrations

After the containers are up and running, run the database migrations:

```bash
./vendor/bin/sail artisan migrate
```

### 8. Access the Application

Once everything is up and running, you can access the Laravel application at:

```
http://localhost
```

### 9. Running Schedule Work for Fetching Exchange Rate API

To run the schedule work for fetching the exchange rate API every midnight, run the following command:

```bash
./vendor/bin/sail artisan schedule:work
```

## Common Sail Commands

Here are some commonly used Sail commands:

-   **Stop Sail**:

    ```bash
    ./vendor/bin/sail down
    ```

-   **Rebuild Sail Containers**:

    ```bash
    ./vendor/bin/sail build
    ```

-   **Running Artisan Commands**:

    ```bash
    ./vendor/bin/sail artisan <command>
    ```

-   **Running Composer Commands**:

    ```bash
    ./vendor/bin/sail composer <command>
    ```

-   **Running NPM Commands**:

    ```bash
    ./vendor/bin/sail npm <command>
    ```

---

## Additional Information

-   **Database Access**: You can access the database using a tool like TablePlus or Sequel Pro with the following credentials:
    -   **Host**: `localhost`
    -   **Port**: `3306`
    -   **Database**: `db_currency_exchange`
    -   **Username**: `sail`
    -   **Password**: `password`

---
