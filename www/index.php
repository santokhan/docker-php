<?php
require_once "db.php";

$pageTitle = "Home";

require_once 'app/helpers/functions.php';
require_once 'app/Router.php';
$router = new Router();

$router->get('/blogs/:slug', function ($slug) {
    include "blogs/slug.php";
});

include "layouts/header.php";

// Fetch blogs with optional image
$sql = "
    SELECT 
        blogs.id,
        blogs.title,
        blogs.slug,
        blogs.content,
        blogs.created_at,
        images.filename AS image
    FROM blogs
    LEFT JOIN images ON blogs.featured_image_id = images.id
    ORDER BY blogs.id DESC
";

$result = $conn->query($sql);

?>

<h1 class="text-2xl font-bold mb-6">Latest Blogs 📝</h1>

<?php if ($result->num_rows > 0): ?>

    <div class="grid gap-6">

        <?php while ($row = $result->fetch_assoc()): ?>

            <div class="bg-white p-5 rounded shadow hover:shadow-md transition">

                <!-- Image (optional) -->
                <?php if (!empty($row['image']) && file_exists("uploads/" . $row['image'])): ?>
                    <img
                        src="/uploads/<?= htmlspecialchars($row['image']) ?>"
                        class="w-full h-48 object-cover rounded mb-4"
                        alt="Blog Image">
                <?php endif; ?>

                <!-- Title -->
                <h2 class="text-xl font-bold text-gray-800">
                    <?= htmlspecialchars($row['title']) ?>
                </h2>

                <!-- Date -->
                <p class="text-sm text-gray-500 mt-1">
                    <?= $row['created_at'] ?>
                </p>

                <!-- Content preview -->
                <p class="mt-3 text-gray-600">
                    <?= substr(strip_tags($row['content']), 0, 150) ?>...
                </p>

                <!-- Read more -->
                <a
                    href="/blogs/<?= generateSlug($row['slug']) ?>"
                    class="inline-block mt-4 text-blue-600 hover:underline">
                    Read More →
                </a>

            </div>

        <?php endwhile; ?>

    </div>

<?php else: ?>

    <div class="bg-white p-6 rounded shadow text-gray-600">
        No blogs found yet. Create your first blog ✍️
    </div>

<?php endif; ?>

<?php include "layouts/footer.php"; ?>