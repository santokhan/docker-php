# 🐳 Important Concept First

Inside Docker Compose:

* PHP container cannot use `localhost`
* MySQL container is accessed by **service name**

So your DB host is:

```text id="host1"
db
```

(from your `docker-compose.yml` service name)

---

# 🔗 1. Basic PHP MySQL Connection (mysqli)

Create file:

```text id="file1"
www/db.php
```

```php id="php1"
<?php

$host = "db";        // Docker service name
$user = "root";
$pass = "root";
$db   = "app";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully!";
```

---

# 🧪 2. Test it

Create:

```text id="test1"
www/index.php
```

```php id="php2"
<?php
require_once "db.php";
```

Then open:

```text id="url1"
http://localhost:8080
```

---

# ⚠️ Common Mistakes (very important)

## ❌ Wrong

```php id="wrong1"
$host = "localhost";
```

👉 This will NOT work inside Docker

---

## ❌ Wrong password confusion

From your docker-compose:

```yaml id="pass1"
MYSQL_ROOT_PASSWORD: root
```

So PHP must use:

```text id="pass2"
root
```

---

# 🧠 Why "db" works

Docker Compose creates a private network:

```text id="net1"
php container  --->  db container
        (service name = db)
```

So:

* `db` resolves internally like a DNS name
* no IP needed

---

# 🚀 Optional (better structure)

If you want clean architecture:

```text id="structure1"
www/
├── config/
│   └── db.php
├── index.php
```

Then:

```php id="php3"
require_once __DIR__ . "/config/db.php";
```

---

# 🔥 Recommended upgrade (PDO version)

If you prefer safer modern PHP:

```php id="pdo1"
<?php

try {
    $pdo = new PDO(
        "mysql:host=db;dbname=app;charset=utf8",
        "root",
        "root"
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully!";
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
```

---

# 📌 Summary

| Thing         | Value         |
| ------------- | ------------- |
| DB Host       | `db`          |
| DB Name       | `app`         |
| User          | `root`        |
| Password      | `root`        |
| PHP extension | mysqli or PDO |
