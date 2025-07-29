<?php
// watermark_util.php
// Utility function to apply a PNG watermark to an image (JPEG, PNG, GIF)
// Usage: require_once 'watermark_util.php'; $outputPath = applyWatermark($imagePath, $watermarkPath);

function applyWatermark($imagePath, $watermarkPath) {
    // Load main image based on type
    $imageType = exif_imagetype($imagePath);
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($imagePath);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($imagePath);
            break;
        default:
            return false;
    }

    $width = imagesx($image);
    $height = imagesy($image);

    // Load watermark PNG
    $watermark = imagecreatefrompng($watermarkPath);
    $watermarkWidth = imagesx($watermark);
    $watermarkHeight = imagesy($watermark);

    // Resize watermark to half width maintaining aspect ratio
    $newWatermarkWidth = round($width / 2);
    $newWatermarkHeight = round(($watermarkHeight * $newWatermarkWidth) / $watermarkWidth);

    $resizedWatermark = imagecreatetruecolor($newWatermarkWidth, $newWatermarkHeight);
    // Preserve transparency
    imagealphablending($resizedWatermark, false);
    imagesavealpha($resizedWatermark, true);
    $transparent = imagecolorallocatealpha($resizedWatermark, 0, 0, 0, 127);
    imagefilledrectangle($resizedWatermark, 0, 0, $newWatermarkWidth, $newWatermarkHeight, $transparent);

    imagecopyresampled($resizedWatermark, $watermark, 0, 0, 0, 0, $newWatermarkWidth, $newWatermarkHeight, $watermarkWidth, $watermarkHeight);

    // Position: middle-right, 20px padding from right
    $xPos = $width - $newWatermarkWidth - 20;
    $yPos = ($height - $newWatermarkHeight) / 2;

    // Manual alpha blending loop
    for ($x = 0; $x < $newWatermarkWidth; $x++) {
        for ($y = 0; $y < $newWatermarkHeight; $y++) {
            $wmColor = imagecolorat($resizedWatermark, $x, $y);
            $alpha = 0.2 ;// Normalize to 0–1 opacity

            if ($alpha > 0) {
                $wmR = ($wmColor >> 16) & 0xFF;
                $wmG = ($wmColor >> 8) & 0xFF;
                $wmB = $wmColor & 0xFF;

                $imgColor = imagecolorat($image, $xPos + $x, $yPos + $y);
                $imgR = ($imgColor >> 16) & 0xFF;
                $imgG = ($imgColor >> 8) & 0xFF;
                $imgB = $imgColor & 0xFF;

                // Manual blend
                $newR = (int)(($alpha * $wmR) + ((1 - $alpha) * $imgR));
                $newG = (int)(($alpha * $wmG) + ((1 - $alpha) * $imgG));
                $newB = (int)(($alpha * $wmB) + ((1 - $alpha) * $imgB));

                $newColor = imagecolorallocate($image, $newR, $newG, $newB);
                imagesetpixel($image, $xPos + $x, $yPos + $y, $newColor);
            }
        }
    }

    // Save final image to temp folder with unique name
    $outputPath = '../temp/' . uniqid() . '.png';

    // Save with alpha support if PNG, else JPEG
    if ($imageType == IMAGETYPE_PNG) {
        imagesavealpha($image, true);
        imagepng($image, $outputPath);
    } else {
        imagejpeg($image, $outputPath, 90);
    }

    // Clean up
    imagedestroy($image);
    imagedestroy($watermark);
    imagedestroy($resizedWatermark);

    return $outputPath;
} 