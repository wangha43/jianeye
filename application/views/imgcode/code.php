<?php
	header('Content-type:image/jpeg');
    session_start();
	error_reporting(E_ALL);
	
	$str= verify(120,30,4);
    
    $_SESSION['imgcode']=$str;
    
	function verify($width,$height,$codeLen){
		#定义一个画布
		$image = imagecreatetruecolor($width, $height);
		#定义颜色
		$black = imagecolorallocate($image, 0, 0, 0);
		$white = imagecolorallocate($image, 255,255,255);
		$blue = imagecolorallocate($image, 0,0,255);
		#画一个矩形
		imagefilledrectangle($image, 0,0, $width,$height, $blue);
		#往图片内写入字符
		$key = '23456789qwertyuipasdfghjkzxcvbnm';
		$len = strlen($key);
		$string  = $codeStr = '';
		$size = 20;
		$baseY = ($height-$size)/2+$size-2;
		$fontfile = './FZSTK.TTF';
		for ($i=0; $i < $codeLen; $i++) {
			$num = rand(1,$len)-1; 
			$string = $key[$num];
			$codeStr .= $string;
			$x = ($width/$codeLen)* $i +10;
			$angle = mt_rand(-45,45);
			imagettftext($image, $size, $angle, $x,$baseY,$white, $fontfile, $string);
		}
        
        imagesetthickness($image,2);
        
        //干扰点
        for($i=1;$i<=20;$i++){
            imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)) );
        }
        
        //干扰线
        
        for($i=1;$i<=1;$i++){
            
            imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)));
        
        }
        
        
		#输出图片
		imagejpeg($image);
		#验证码字符串，会在后期：会话控制或Ajax时使用到
		return $codeStr;
	}
	

?>