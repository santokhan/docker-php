<?php
$title = "Create Blog Post";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="/assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Create New Blog ✍️
    </h1>

    <form method="POST" action="store-blog.php" class="space-y-5">

        <!-- Title -->
        <div>
            <label class="block text-gray-700 mb-1">Title</label>
            <input 
                type="text" 
                name="title"
                required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="Enter blog title"
            >
        </div>

        <!-- Slug -->
        <div>
            <label class="block text-gray-700 mb-1">Slug</label>
            <input 
                type="text" 
                name="slug"
                required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="my-first-blog"
            >
        </div>

        <!-- Content -->
        <div>
            <label class="block text-gray-700 mb-1">Content</label>
            <textarea 
                name="content"
                rows="6"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="Write your blog content..."
            ></textarea>
        </div>

        <!-- Featured Image ID -->
        <div>
            <label class="block text-gray-700 mb-1">Featured Image ID</label>
            <input 
                type="number" 
                name="featured_image_id"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="Image ID (optional)"
            >
        </div>

        <!-- Status -->
        <div>
            <label class="block text-gray-700 mb-1">Status</label>
            <select 
                name="status"
                class="w-full border rounded px-3 py-2"
            >
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

        <!-- Submit -->
        <button 
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
        >
            Create Blog
        </button>

    </form>
</div>

</body>
</html>