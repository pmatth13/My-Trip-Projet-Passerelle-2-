<?php
/**
 * Script d'upload d'images pour TinyMCE
 */

// Dossier de destination des uploads
$uploadDir = 'public/uploads/';

// Creer le dossier s'il n'existe pas
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Verifier qu'un fichier a ete envoye
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Aucun fichier recu ou erreur d\'upload']);
    exit;
}

$file = $_FILES['file'];

// Extensions autorisees
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (!in_array($fileExtension, $allowedExtensions)) {
    http_response_code(400);
    echo json_encode(['error' => 'Type de fichier non autorise. Extensions acceptees: ' . implode(', ', $allowedExtensions)]);
    exit;
}

// Verifier le type MIME
$allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mimeType, $allowedMimes)) {
    http_response_code(400);
    echo json_encode(['error' => 'Type MIME non autorise']);
    exit;
}

// Taille max: 5 Mo
$maxSize = 5 * 1024 * 1024;
if ($file['size'] > $maxSize) {
    http_response_code(400);
    echo json_encode(['error' => 'Fichier trop volumineux (max 5 Mo)']);
    exit;
}

// Generer un nom unique pour eviter les conflits
$newFileName = uniqid('img_', true) . '.' . $fileExtension;
$destination = $uploadDir . $newFileName;

// Deplacer le fichier
if (move_uploaded_file($file['tmp_name'], $destination)) {
    // Retourner l'URL pour TinyMCE
    $imageUrl = '/my_trip/' . $destination;
    echo json_encode(['location' => $imageUrl]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de l\'enregistrement du fichier']);
}
