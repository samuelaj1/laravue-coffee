# Competence Development
Laravel Task

## Installation Guide

### Prerequisites

Ensure you have the following installed on your machine:

- Docker & Docker Compose
- Git
- Composer
- Node.js & npm

### Cloning the Repository

```sh
git clone https://github.com/samuelaj1/laravue-coffee.git
cd laravue-coffee
```

### Setting Up Environment Variables

Copy the example environment file:

```sh
cp .env.example .env
```

Update `.env` file to match your database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravue
DB_USERNAME=user
DB_PASSWORD=password
```

### Running the Project with Docker

```sh
docker-compose up -d --build
```

This command will start the **app**, **MySQL database**, and **Nginx server**.


### Running Migrations & Seeding Database

```sh
docker-compose exec app php artisan migrate --seed
```

[//]: # (### &#40;OPTIONAL&#41; Running Laravel Development Server &#40;if not using Nginx&#41;)

[//]: # ()
[//]: # (```sh)

[//]: # (docker-compose exec app php artisan serve --host=0.0.0.0 --port=8000)

[//]: # (```)

Your project should now be accessible at [**http://localhost:8000**](http://localhost:8000)

---

## Project Structure

```
├── app/              # Laravel application logic
├── bootstrap/        # Application bootstrap files
├── config/           # Configuration files
├── database/         # Migrations, seeders, factories
│   ├── factories/
│   ├── migrations/
│   ├── seeders/
├── public/           # Public assets
├── resources/        # Views, Vue components
│   ├── js/
│   ├── sass/
├── routes/           # routes
├── storage/          # Logs, cached views
├── tests/            # Application tests
├── docker-compose.yml # Docker setup
├── nginx.conf        # Nginx configuration
└── README.md         # Project documentation
```

---

## Additional Docker Commands

### Checking Logs

```sh
docker-compose logs -f app
```

### Running Artisan Commands

```sh
docker-compose exec app php artisan <command>
```

### Running Composer Commands

```sh
docker-compose exec app composer <command>
```

### Stopping Containers

```sh
docker-compose down
```

---

## Database Seeding

The project includes a database seeder to populate initial data. To run the seeder:

```sh
docker-compose exec app php artisan db:seed
```

This will insert sample records into the database.

---

## Troubleshooting

If you encounter database connection errors, try running:

```sh
docker-compose exec app php artisan config:clear
```

If the issue persists, restart the containers:

```sh
docker-compose down
docker-compose up -d --build
```

---
