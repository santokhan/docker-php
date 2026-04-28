<?php
$pageTitle = "Create Blog Post";
include "../../layouts/header.php";

// Example (for edit mode)
$post = [
    "featured_image" => [ "id" => 0, "filename" => "" ]
];
?>

<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Create New Blog ✍️
    </h1>

    <form method="POST" action="/store-blog.php" enctype="multipart/form-data" class="space-y-5">

        <!-- Title -->
        <div>
            <label class="block text-gray-700 mb-1">Title</label>
            <input
                type="text"
                name="title"
                required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="Enter blog title">
        </div>

        <!-- Slug -->
        <div>
            <label class="block text-gray-700 mb-1">Slug</label>
            <input
                type="text"
                name="slug"
                required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="my-first-blog">
        </div>

        <!-- Content -->
        <div>
            <label class="block text-gray-700 mb-1">Content</label>
            <textarea
                name="content"
                rows="6"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="Write your blog content..."></textarea>
        </div>

        <!-- Featured Image -->
        <div>
            <label class="block text-gray-700 mb-1">
                Featured Image (optional)
            </label>

            <!-- File input -->
            <input
                type="file"
                name="featured_image"
                id="featuredImageInput"
                accept="image/*"
                class="w-full border rounded px-3 py-2">

            <!-- store uploaded image ID -->
            <input type="hidden" name="featured_image_id" id="featured_image_id">

            <p class="text-sm text-gray-500 mt-1">
                You can add or change this later
            </p>

            <!-- Preview -->
            <div class="mt-3">
                <?php if (!empty($post['featured_image']['filename'])): ?>
                    <img
                        id="imagePreview"
                        src="<?= $post['featured_image']['filename'] ?>"
                        class="w-full aspect-video object-cover rounded border mt-3">
                <?php else: ?>
                    <img
                        id="imagePreview"
                        class="hidden w-full aspect-video object-cover rounded border mt-3">
                <?php endif; ?>
            </div>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-gray-700 mb-1">Status</label>
            <select
                name="status"
                class="w-full border rounded px-3 py-2">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Create Blog
        </button>

    </form>
</div>

<!-- JS Preview + Upload -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.querySelector('#featuredImageInput');
    const preview = document.querySelector('#imagePreview');
    const hiddenId = document.querySelector('#featured_image_id');

    input.addEventListener('change', async function (e) {

        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append("image", file);

        try {
            const res = await fetch("/upload-image.php", {
                method: "POST",
                body: formData
            });

            const data = await res.json();

            if (!data) {
                alert("Upload failed");
                return;
            }

            // store image ID for backend
            if (data.id) {
                hiddenId.value = data.id;
            }

            // show preview from server
            if (data.filename) {
                preview.src = `/uploads/${data.filename}`;
                preview.classList.remove('hidden');
            }

        } catch (err) {
            console.error(err);
            alert("Upload error");
        }
    });

    // click image to open file picker
    function openFilePicker() {
        input?.click();
    }

    if (preview) {
        preview.addEventListener('click', openFilePicker);
    }

});
</script>

<?php include "../../layouts/footer.php"; ?>