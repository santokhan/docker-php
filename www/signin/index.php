<?php
$title = "Sign In";
include "../layouts/header.php";

// Example (for edit mode)
$post = [
    "featured_image" => ["id" => 0, "filename" => ""]
];
?>

<div class="max-w-md mx-auto mt-20 bg-white p-8 rounded shadow">

    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">
        Sign In 🔐
    </h1>

    <!-- Error message (optional) -->
    <?php if (!empty($_GET['error'])): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/auth/login.php" class="space-y-5">

        <!-- Email -->
        <div>
            <label class="block text-gray-700 mb-1">Email</label>
            <input
                type="email"
                name="email"
                required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="you@example.com">
        </div>

        <!-- Password -->
        <div>
            <label class="block text-gray-700 mb-1">Password</label>
            <input
                type="password"
                name="password"
                required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="••••••••">
        </div>

        <!-- Remember -->
        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" class="text-sm text-gray-600">
                Remember me
            </label>
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Sign In
        </button>

    </form>

    <!-- Extra links -->
    <div class="mt-5 text-center text-sm text-gray-600">
        <a href="/signup" class="text-blue-600 hover:underline">
            Create account
        </a>
    </div>

</div>

<?php include "../layouts/footer.php"; ?>