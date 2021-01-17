<?php
$flurl =  $_SERVER['QUERY_STRING'];
parse_str($flurl, $url); 
$ress = explode('x',$url['res']);
function createImage($imagel,$type) {
    if ($type == 1) {return imagecreatefromgif($imagel);}
    if ($type == 2) {return imagecreatefromjpeg($imagel);}
    if ($type == 3) {return imagecreatefrompng($imagel);}
    return false;
}
$info = getimagesize($url['img']);
$mimetype = $info[2];
$image = createImage($url['img'],$mimetype);
$img=imagescale($image,$ress[0],$ress[1]);
$width = imagesx($img);
$height = imagesy($img);
$str = $width . 'x' . $height . ';';
for($y=0;$y<$height;$y++) {
    for($x=0;$x<$width;$x++) {
        $rgb = imagecolorat($img,$x,$y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        // Write colors in digital screen's format of 'RRRGGGBBB'
        $str .= sprintf('%03d%03d%03d',$r,$g,$b);
    }
}
echo $str;
//[Copyright (c) 2021 PowerBuxoK]//
?>
