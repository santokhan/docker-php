<?php
$title = "Sign Up";
include "../../layouts/header.php";

// // Optional flash error (recommended approach)
// session_start();
?>

<div class="max-w-md mx-auto mt-20 bg-white p-8 rounded shadow">

    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">
        Create Account ✨
    </h1>

    <!-- Error message -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="/auth/signup.php" class="space-y-5">

        <!-- Name -->
        <div>
            <label class="block text-gray-700 mb-1">Full Name</label>
            <input
                type="text"
                name="name"
                required
                autocomplete="name"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="John Doe">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-gray-700 mb-1">Email</label>
            <input
                type="email"
                name="email"
                required
                autocomplete="email"
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
                autocomplete="new-password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="••••••••">
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-gray-700 mb-1">Confirm Password</label>
            <input
                type="password"
                name="confirm_password"
                required
                autocomplete="new-password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="••••••••">
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
            Create Account
        </button>

    </form>

    <!-- Links -->
    <div class="mt-5 text-center text-sm text-gray-600">
        Already have an account?
        <a href="/signin" class="text-blue-600 hover:underline">
            Sign in
        </a>
    </div>

</div>

<?php include "../../layouts/footer.php"; ?>