<?php
    namespace App\Services;
    use Exception;

    class ImageService {

        public static function getImagesPath(array $images): array {
            $principal = 1;
            $processedImages = [];
            $uploadDir = __DIR__ . "/../../public/assets/images/produits/";
            $fileCount = count($images['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                if ($images['error'][$i] !== UPLOAD_ERR_OK) {
                    throw new Exception("Erreur lors du téléchargement du fichier " . $images['name'][$i]);
                }
            
                if (empty($images['tmp_name'][$i])) {
                    continue;
                }
            
                $maxSize = 2 * 1024 * 1024;
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                
                $fileName = $images['name'][$i];
                $tmpFilePath = $images['tmp_name'][$i];
                $fileSize = filesize($tmpFilePath);
                
                if ($fileSize > $maxSize) {
                    throw new Exception("Le fichier $fileName dépasse la taille maximale de 2 Mo.");
                }
                
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                
                if (!in_array($extension, $allowedExtensions)) {
                    throw new Exception("Extension $extension non autorisée pour $fileName.");
                }
                
                $uniqueFilename = uniqid('img_', true) . '.' . $extension;
                $destinationPath = $uploadDir . $uniqueFilename;
                
                if (!move_uploaded_file($tmpFilePath, $destinationPath)) {
                    throw new Exception("Erreur lors du déplacement du fichier $fileName.");
                }
                
                $processedImages[] = [
                    "url" => "assets/images/produits/" . $uniqueFilename,
                    "principal" => $principal
                ];
                
                $principal = 0;
            }

            return $processedImages;
        }
    }
