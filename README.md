# Export thing

This project implements a modular, extensible, and type-safe **data export system** in **Symfony 7.2** and **PHP 8.4**.

## ✅ Requirements

- **Docker** with **Docker Compose** installed
- any IDE or Code Editor with **PHP 8.4** support

## 🛠️ Setup

### 1. Launch the Docker containers

```bash
docker compose up --build -d
```

### 2. Install the dependencies

```bash
docker exec -it export-thing-php composer install
```

### 3. Try it out

Open your browser and navigate to [http://localhost:8000/vehicles/export](http://localhost:8000/vehicles/export) to export a list of vehicles.

## 💡 Useful commands

### Stop the containers

```bash
docker compose down
```
