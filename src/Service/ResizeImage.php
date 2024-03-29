<?php
namespace App\Service;

class ResizeImage
{
	private $container;
	private $path = '';
	private $pathResize = '';
	private $pathOutput = '';
	private $pathOutputResize = '';
	private $errors = '';

	public function __construct($path, $pathResize, $pathOutput, $pathOutputResize)
    {
		$this->path = $path;
		$this->pathResize = $pathResize;
		$this->pathOutput = $pathOutput;
		$this->pathOutputResize = $pathOutputResize;
    }

    public function resizeImageGet(string $file, array $arSize) :string
	{
		$fileName = $this->path. $file;

		if(!is_file($fileName))
			return $this->pathOutput . $file;

		$imgInfo = getimagesize($fileName);
		$width = $imgInfo[0];
		$height = $imgInfo[1];

		if($width <= $arSize['width'] || $height <= $arSize['height'])
			return $this->pathOutput . $file;

		if($cacheFile = $this->checkCache($file, $arSize)){
			return $cacheFile;
		}

		$resizeFile = $this->resizeImage($fileName, $file, $arSize['width'], $arSize['height'], $width, $height, $imgInfo['mime']);

		return $resizeFile;
	}

	private function resizeImage(string $fileName, string $file, int $width, int $height, int $width_orig, int $height_orig, string $mime)
	{
		$ratio_orig = $width_orig/$height_orig;
		$widthNew = $width;
		$heightNew = $height;
		if($width/$height > $ratio_orig){
			$widthNew = $height*$ratio_orig;
		} else {
			$heightNew = $width/$ratio_orig;
		}
		switch($mime){
			case 'image/jpeg':
				$src = \imagecreatefromjpeg($fileName);
				break;
			case 'image/png':
				$src = \imagecreatefrompng($fileName);
				break;
			case 'image/webp':
				$src = \imagecreatefromwebp($fileName);
				break;
		}
		$dst = \imagecreatetruecolor($widthNew, $heightNew);
		$black = ImageColorAllocate($dst, 255, 255, 255); // черный цвет
		$trans = imagecolortransparent($dst, $black); // теперь черный прозрачен
		ImageFill($dst, 0, 0, $black); //заливка прозрачным цветом
		\imagecopyresampled($dst, $src, 0, 0, 0, 0, $widthNew, $heightNew, $width_orig, $height_orig);

		switch($mime){
			case 'image/jpeg':
				\imageJPEG($dst, $this->pathResize . $width . '_' . $height.  '/' .$file);
				break;
			case 'image/png':
				\imagepng($dst, $this->pathResize . $width . '_' . $height.  '/' .$file);
				break;
			case 'image/webp':
				\imagewebp($dst, $this->pathResize . $width . '_' . $height.  '/' .$file);
				break;
		}
		
		return $this->pathOutputResize . $width . '_' . $height.  '/' .$file;
	}

	private function checkCache(string $file, array $arSize)
	{
		$dir = $this->pathResize . $arSize['width'] . '_' . $arSize['height'];
		if(!is_dir($dir)){
			mkdir($dir, 0755, true);
			return false;
		}
		if(!file_exists($dir . '/' . $file))
			return false;

		return $this->pathOutputResize . $arSize['width'] . '_' . $arSize['height'] . '/' .$file;
	}

	private function getNewSizes(int $width_orig, int $height_orig) :array
	{
		$ratio_orig = $width_orig/$height_orig;
		if($width/$height > $ratio_orig){
			$width = $height*$ratio_orig;
		} else {
			$height = $width/$ratio_orig;
		}
	}
}