<?php

require_once "../../db.php";

// =====================
// TEMP USER (replace later with session)
// =====================
$user_id = 2;

// =====================
// FORM DATA
// =====================
$title = $_POST['title'] ?? '';
$slug = $_POST['slug'] ?? '';
$content = $_POST['content'] ?? '';
$status = $_POST['status'] ?? 'draft';

// =====================
// VALIDATION
// =====================
if (!$title || !$slug) {
    die("Title and slug are required");
}

// =====================
// HANDLE IMAGE UPLOAD (optional)
// =====================
$featured_image_id = null;

// Only process image IF uploaded
if (
    isset($_FILES['featured_image']) &&
    $_FILES['featured_image']['error'] === 0 &&
    $_FILES['featured_image']['size'] > 0
) {

    $file = $_FILES['featured_image'];

    $filename = time() . "_" . basename($file['name']);
    $targetPath = "uploads/" . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {

        $mime = $file['type'];
        $size = $file['size'];

        $stmt = $conn->prepare("
            INSERT INTO images (user_id, filename, mime_type, size)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param("issi", $user_id, $filename, $mime, $size);
        $stmt->execute();

        $featured_image_id = $stmt->insert_id;
    }
}

// =====================
// INSERT BLOG
// =====================
$stmt = $conn->prepare("
    INSERT INTO blogs (user_id, title, slug, content, featured_image_id, status)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "isssis",
    $user_id,
    $title,
    $slug,
    $content,
    $featured_image_id,
    $status
);

if ($stmt->execute()) {
    header("Location: /index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}