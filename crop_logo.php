<?php
$inputFile = 'public/images/smarterp_logo.jpg';
$outputFile = 'public/images/smarterp_logo_cropped.jpg';

$img = imagecreatefromjpeg($inputFile);

// Get image dimensions
$width = imagesx($img);
$height = imagesy($img);

// Find the bounding box of the non-white pixels
$minX = $width;
$minY = $height;
$maxX = 0;
$maxY = 0;

// Tolerance for white (e.g., 240-255)
$tolerance = 245;

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $rgb = imagecolorat($img, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        if ($r < $tolerance || $g < $tolerance || $b < $tolerance) {
            if ($x < $minX) $minX = $x;
            if ($x > $maxX) $maxX = $x;
            if ($y < $minY) $minY = $y;
            if ($y > $maxY) $maxY = $y;
        }
    }
}

// Add a little padding
$padding = 20;
$minX = max(0, $minX - $padding);
$minY = max(0, $minY - $padding);
$maxX = min($width - 1, $maxX + $padding);
$maxY = min($height - 1, $maxY + $padding);

$newWidth = $maxX - $minX + 1;
$newHeight = $maxY - $minY + 1;

// Make it square
$size = max($newWidth, $newHeight);
$squareImg = imagecreatetruecolor($size, $size);
$white = imagecolorallocate($squareImg, 255, 255, 255);
imagefill($squareImg, 0, 0, $white);

$dstX = ($size - $newWidth) / 2;
$dstY = ($size - $newHeight) / 2;

imagecopy($squareImg, $img, $dstX, $dstY, $minX, $minY, $newWidth, $newHeight);

imagejpeg($squareImg, $outputFile, 100);
imagedestroy($img);
imagedestroy($squareImg);

echo "Cropped image successfully.\n";
