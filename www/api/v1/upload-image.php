<?php
require_once "../../db.php";

$user_id = 2;

header('Content-Type: application/json');

if (!isset($_FILES['image'])) {
    echo json_encode([
        "success" => false,
        "message" => "No file uploaded"
    ]);
    exit;
}

$file = $_FILES['image'];

if ($file['error'] !== 0) {
    echo json_encode([
        "success" => false,
        "message" => "Upload error"
    ]);
    exit;
}

$uploadDir = __DIR__ . "www/public/uploads";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0775, true);
}

// safer extension handling
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!$ext) {
    $ext = "jpg";
}

$filename = time() . "_" . bin2hex(random_bytes(6)) . "." . $ext;

$targetPath = $uploadDir . $filename;

if (move_uploaded_file($file['tmp_name'], $targetPath)) {

    $mime = mime_content_type($targetPath);
    $size = $file['size'];

    $stmt = $conn->prepare("
        INSERT INTO images (user_id, filename, mime_type, size)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("issi", $user_id, $filename, $mime, $size);
    $stmt->execute();

    echo json_encode([
        "success" => true,
        "image_id" => $stmt->insert_id,
        "filename" => $filename,
        "mime" => $mime,
        "size" => $size,
        "url" => "/uploads/" . $filename
    ]);

} else {
    echo json_encode([
        "success" => false,
        "message" => "Failed to move file"
    ]);
}