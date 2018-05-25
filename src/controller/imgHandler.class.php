<?php

/**
* Обработка изображений, уменьшение качаства и размера
*/
class imgHandler
{
	private $dst;
	private $path;

	function __construct($path, $w, $h, $crop=FALSE)
	{
		$this->path = $path;
		list($width, $height) = getimagesize($path);
	    $r = $width / $height;
	    if ($crop) {
	        if ($width > $height) {
	            $width = ceil($width-($width*abs($r-$w/$h)));
	        } else {
	            $height = ceil($height-($height*abs($r-$w/$h)));
	        }
	        $newwidth = $w;
	        $newheight = $h;
	    } else {
	        if ($w/$h > $r) {
	            $newwidth = $h*$r;
	            $newheight = $h;
	        } else {
	            $newheight = $w/$r;
	            $newwidth = $w;
	        }
	    }
	    $src = imagecreatefromjpeg($path);
	    $dst = imagecreatetruecolor($newwidth, $newheight);
	    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	    $this->dst = $dst;
    }

    public function newImg()
    {
    	return imagejpeg($this->dst, $this->path, 90);
    }
}

