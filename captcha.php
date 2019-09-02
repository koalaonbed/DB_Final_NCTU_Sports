<?php
    if(!isset($_SESSION)){ session_start(); }
        $_SESSION['check_word'] = '';
		
    Header("Content-type: image/PNG");

    imgcode(5,120,30);

    function imgcode($nums,$width,$high) {
       
        $str = "0123456789";
        $code = '';
        for ($i = 0; $i < $nums; $i++) {
            $code .= $str[mt_rand(0, strlen($str)-1)];
        }

        $_SESSION['check_word'] = $code;

        $image = imagecreate($width, $high);
        $black = imagecolorallocate($image, mt_rand(0, 200), mt_rand(0, 200), mt_rand(0, 200));
        $border_color = imagecolorallocate($image, 21, 106, 235);
        $background_color = imagecolorallocate($image, 235, 236, 237);

        imagefilledrectangle($image, 0, 0, $width, $high, $background_color);

        imagerectangle($image, 0, 0, $width-1, $high-1, $border_color);

        for ($i = 0; $i < 80; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $high), $black);
        }
       
        $strx = rand(3, 8);
        for ($i = 0; $i < $nums; $i++) {
            $strpos = rand(1, 6);
            imagestring($image, 5, $strx, $strpos, substr($code, $i, 1), $black);
            $strx += rand(10, 30);
        }

        imagepng($image);
        imagedestroy($image);
    }
?>