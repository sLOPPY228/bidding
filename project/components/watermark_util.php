<?php


function applyWatermark($imagePath, $watermarkPath) {
 //image format check garne
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

    $watermark = imagecreatefrompng($watermarkPath);
    $watermarkWidth = imagesx($watermark);
    $watermarkHeight = imagesy($watermark);

    // watermark lai resize garne
    $newWatermarkWidth = round($width / 2);
    $newWatermarkHeight = round(($watermarkHeight * $newWatermarkWidth) / $watermarkWidth);

    $resizedWatermark = imagecreatetruecolor($newWatermarkWidth, $newWatermarkHeight);
    // Preserve transparency
    imagealphablending($resizedWatermark, false);
    imagesavealpha($resizedWatermark, true);
    $transparent = imagecolorallocatealpha($resizedWatermark, 0, 0, 0, 127);
    imagefilledrectangle($resizedWatermark, 0, 0, $newWatermarkWidth, $newWatermarkHeight, $transparent);

    imagecopyresampled($resizedWatermark, $watermark, 0, 0, 0, 0, $newWatermarkWidth, $newWatermarkHeight, $watermarkWidth, $watermarkHeight);

    $xPos = $width - $newWatermarkWidth - 20;
    $yPos = ($height - $newWatermarkHeight) / 2;

    for ($x = 0; $x < $newWatermarkWidth; $x++) {
        for ($y = 0; $y < $newWatermarkHeight; $y++) {
            $wmColor = imagecolorat($resizedWatermark, $x, $y);
            $alpha = 0.2 ;

            if ($alpha > 0) {
                $wmR = ($wmColor >> 16) & 255;
                $wmG = ($wmColor >> 8) & 255;
                $wmB = $wmColor & 255;

                $imgColor = imagecolorat($image, $xPos + $x, $yPos + $y);
                $imgR = ($imgColor >> 16) & 255;
                $imgG = ($imgColor >> 8) & 255;
                $imgB = $imgColor & 255;

                // Manual blend
                $newR = (int)(($alpha * $wmR) + ((1 - $alpha) * $imgR));
                $newG = (int)(($alpha * $wmG) + ((1 - $alpha) * $imgG));
                $newB = (int)(($alpha * $wmB) + ((1 - $alpha) * $imgB));

                $newColor = imagecolorallocate($image, $newR, $newG, $newB);
                imagesetpixel($image, $xPos + $x, $yPos + $y, $newColor);
            }
        }
    }

    $outputPath = '../temp/' . uniqid() . '.png';
//save image
    if ($imageType == IMAGETYPE_PNG) {
        imagesavealpha($image, true);
        imagepng($image, $outputPath);
    } else {
        imagejpeg($image, $outputPath, 90);
    }

    imagedestroy($image);
    imagedestroy($watermark);
    imagedestroy($resizedWatermark);

    return $outputPath;
} 