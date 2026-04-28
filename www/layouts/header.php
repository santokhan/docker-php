<?php
if (!isset($pageTitle)) {
    $pageTitle = "My Blog App";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link href="/assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

<!-- Navbar -->
<header class="bg-gray-900 text-white shadow">
    <div class="max-w-6xl mx-auto flex justify-between items-center p-4">

        <a href="/index.php" class="text-xl font-bold">
            BlogApp 🚀
        </a>

        <nav class="space-x-4">
            <a href="/" class="hover:text-blue-400">Home</a>
            <a href="/blogs/new" class="hover:text-blue-400">Create Blog</a>
        </nav>

    </div>
</header>

<!-- Page Content -->
<main class="max-w-6xl mx-auto p-6">