# 📘 Project Documentation: PHP + MySQL (Docker Compose)

## 📌 Overview

This setup runs a basic web application using:

* **PHP 8.2 with Apache** (for backend + server)
* **MySQL 8** (for database)

It is designed for quick local development or simple deployment.

---

## 📁 Project Structure

```
project-root/
│
├── docker-compose.yml
├── Dockerfile.yml
│
├── db/
│   ├── init.sql
│   ├── schema.sql
│   └── seed.sql
│
├── tailwind/
│   └── input.css
│
├── www/
│   ├── api
│   │   └── v1
│   │       └── upload-image.php
│   ├── app
│   ├── assets
│   │   └── css
│   │       └── output.css
│   ├── layouts
│   └── index.php
│
├── package-lock.json
├── package.json
├── postcss.config.js
├── tailwind.config.js
└── README.md
```

* `www/` → Your PHP application files
* `docker-compose.yml` → Defines services (web + database)

---

## 🐳 Services

### 1. Web Service (PHP + Apache)

```yaml
web:
  image: php:8.2-apache
  ports:
    - "8080:80"
  volumes:
    - ./www:/var/www/html
```

### 🔹 Explanation:

* `image: php:8.2-apache` → Runs PHP with Apache server
* `ports: 8080:80` → Maps local port **8080 → container port 80**
* `volumes` → Syncs your local `./www` folder with Apache root directory

### 🌐 Access:

```
http://localhost:8080
```

---

### 2. Database Service (MySQL)

```yaml
db:
  image: mysql:8
  environment:
    MYSQL_ROOT_PASSWORD: root
    MYSQL_DATABASE: app
```

### 🔹 Explanation:

* `image: mysql:8` → Runs MySQL version 8
* `MYSQL_ROOT_PASSWORD` → Root user password
* `MYSQL_DATABASE` → Automatically creates a database named `app`

---

## 🔗 Connecting PHP to MySQL

Use these credentials inside your PHP code:

```php
$host = "db"; // service name from docker-compose
$user = "root";
$password = "root";
$database = "app";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
```

### ⚠️ Important:

* Host is **db** (NOT localhost)
* Because both services run inside Docker network

---

## 🚀 How to Run

### Step 1: Start containers

```bash
docker-compose up -d
```

### Step 2: Check running containers

```bash
docker-compose ps
```

### Step 3: Stop containers

```bash
docker-compose down
```

---

## 🧪 Test Setup

Create file:

```
www/index.php
```

```php
<?php
echo "Hello Docker PHP!";
?>
```

Open:

```
http://localhost:8080
```

---

## 🧠 Notes

* MySQL data is **not persistent** in this setup (no volume added)
* This is a **development setup**, not production-ready
* No phpMyAdmin included (can be added if needed)

---

## 🔧 Optional Improvements (Recommended)

If you want better setup later:

* Add **phpMyAdmin**
* Add **MySQL volume (data persistence)**
* Add **custom Dockerfile for PHP extensions**
* Add **.env file for credentials**
