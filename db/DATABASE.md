# 🐳 1. Open MySQL inside Docker container

```bash id="m1q9x2"
docker exec -it <mysql_container_name> mysql -u root -p
```

Then enter password:

```
root
```

---

# 🔍 2. Find your container name

```bash id="c8k2fd"
docker ps
```

Look for something like:

```
project-db-1
```

Then use it:

```bash id="x9p3aa"
docker exec -it project-db-1 mysql -u root -p
```

---

# 📦 3. Show databases

Inside MySQL shell:

```sql id="sql1"
SHOW DATABASES;
```

---

# 📂 4. Use your database

```sql id="sql2"
USE app;
```

---

# 🧱 5. Show tables

```sql id="sql3"
SHOW TABLES;
```

---

# 👀 6. View table data

```sql id="sql4"
SELECT * FROM users;
SELECT * FROM blogs;
```

---

# ⚡ 7. One-line direct query (no shell)

If you want to run a command directly:

```bash id="oneline1"
docker exec -it project-db-1 mysql -u root -proot -e "SHOW DATABASES;"
```

---

# 🧪 8. Export DB to text file (SQL dump)

If you meant “text DB” as in backup:

```bash id="dump1"
docker exec project-db-1 mysqldump -u root -proot app > backup.sql
```

---

# 🧠 Summary

| Task          | Command                                      |
| ------------- | -------------------------------------------- |
| Open DB shell | `docker exec -it container mysql -u root -p` |
| List DBs      | `SHOW DATABASES;`                            |
| Select DB     | `USE app;`                                   |
| View tables   | `SHOW TABLES;`                               |
| Export DB     | `mysqldump`                                  |
