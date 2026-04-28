# 🚀 Goal

You will get:

* Tailwind installed
* Auto build CSS
* PHP serving compiled CSS
* Simple dev workflow

---

# 📁 1. Project structure

Add this:

```text id="tree1"
project-root/
│
├── www/
│   ├── index.php
│   ├── assets/
│   │   ├── css/
│   │   │   └── output.css   (generated)
│   │   └── js/
│
├── tailwind/
│   ├── input.css
│   ├── tailwind.config.js
│
├── package.json
├── docker-compose.yml
├── Dockerfile
```

---

# ⚙️ 2. Install Node + Tailwind (on your host machine)

Run:

```bash id="t1"
npm init -y
npm install -D tailwindcss@3.4.17 postcss autoprefixer
npx tailwindcss init -p
```

---

# 🧠 3. Configure Tailwind

Edit:

```js id="t2"
// tailwind.config.js
module.exports = {
  content: ["./www/**/*.{php,html,js}"],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

---

# 🎨 4. Create input CSS

```text id="t3"
tailwind/input.css
```

```css id="t4"
@tailwind base;
@tailwind components;
@tailwind utilities;
```

---

# 📦 5. Add build script

Update `package.json`:

```json id="t5"
"scripts": {
  "dev": "tailwindcss -i ./tailwind/input.css -o ./www/assets/css/output.css --watch",
  "build": "tailwindcss -i ./tailwind/input.css -o ./www/assets/css/output.css --minify"
}
```

---

# ▶️ 6. Start development

Run:

```bash id="t6"
npm run dev
```

Now Tailwind watches changes automatically.

---

# 🌐 7. Use in PHP

In your `index.php`:

```php id="t7"
<!DOCTYPE html>
<html>
<head>
    <title>Blog App</title>
    <link href="/assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="p-10">
        <h1 class="text-3xl font-bold text-blue-600">
            Hello Tailwind + PHP 🚀
        </h1>
    </div>
</body>
</html>
```

---

# 🐳 OPTIONAL (run Tailwind inside Docker)

If you want full Docker dev setup:

Add service:

```yaml id="t8"
node:
  image: node:20
  working_dir: /app
  volumes:
    - ./:/app
  command: npm run dev
```

Then run both:

```bash id="t9"
docker-compose up
```

---

# ⚠️ Important notes

### ✔ PHP container

* Only serves files
* No build system

### ✔ Tailwind

* Must be built into static CSS

### ✔ Output file

```text id="t10"
www/assets/css/output.css
```

---

# 🧠 Dev workflow

### Terminal 1:

```bash id="t11"
docker-compose up
```

### Terminal 2:

```bash id="t12"
npm run dev
```

---

# 🚀 Summary

| Tool            | Role               |
| --------------- | ------------------ |
| PHP + Apache    | backend + server   |
| MySQL           | database           |
| Node + Tailwind | frontend styling   |
| output.css      | final compiled CSS |

---
