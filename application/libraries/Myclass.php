<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myclass { 
    /**
     * 函数库 
     * @author wxc
     *
     */
     
     // 注释  单行
     # 单行
     
     /* 
        多行注释 
     */
     
     //文档注释
     //函数的注释


/**
 * 
 * 字符截取
 * @param string $string
 * @param int $start
 * @param int $length
 * @param string $charset
 * @param string $dot
 * 
 * @return string
 */
function str_cut(&$string, $start, $length, $charset = "utf-8", $dot = '') {
	if(function_exists('mb_substr')) {
		if(mb_strlen($string, $charset) > $length) {
			return mb_substr ($string, $start, $length, $charset) . $dot;
		}
		return mb_substr ($string, $start, $length, $charset);
		
	}else if(function_exists('iconv_substr')) {
		if(iconv_strlen($string, $charset) > $length) {
			return iconv_substr($string, $start, $length, $charset) . $dot;
		}
		return iconv_substr($string, $start, $length, $charset);
	}

	$charset = strtolower($charset);
	switch ($charset) {
		case "utf-8" :
			preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $ar);
			if(func_num_args() >= 3) {
				if (count($ar[0]) > $length) {
					return join("", array_slice($ar[0], $start, $length)) . $dot;
				}
				return join("", array_slice($ar[0], $start, $length));
			} else {
				return join("", array_slice($ar[0], $start));
			}
			break;
		default:
			$start = $start * 2;
			$length   = $length * 2;
			$strlen = strlen($string);
			for ( $i = 0; $i < $strlen; $i++ ) {
				if ( $i >= $start && $i < ( $start + $length ) ) {
					if ( ord(substr($string, $i, 1)) > 129 ) $tmpstr .= substr($string, $i, 2);
					else $tmpstr .= substr($string, $i, 1);
				}
				if ( ord(substr($string, $i, 1)) > 129 ) $i++;
			}
			if ( strlen($tmpstr) < $strlen ) $tmpstr .= $dot;
			return $tmpstr;
	}
}



/**
 * @param $sql string sql语句
 * @return 一个二维的数组结果
 */
function get_all($sql){
    $data=array();
    $res=mysql_query($sql);
    if ($res && mysql_num_rows($res)) {
        while ($tmp=mysql_fetch_assoc($res)) {
            $data[]=$tmp;
        }
        mysql_free_result($res);//释放结果集
    }
    return $data;
}

/**
 * 获取一行数据
 * @param string $sql
 * @return 一个一维数组
 */
function get_one($sql){
   $data=array();
    $res=mysql_query($sql);
    if ($res && mysql_num_rows($res)) {			
        $data=mysql_fetch_assoc($res);
        mysql_free_result($res);//释放结果集
    }
    return $data;
}




//提醒
function show_msg($msg,$url=''){    
    echo '<script>';
    echo 'alert("'.$msg.'");';
    if(empty($url)){
      echo 'window.history.go(-1);';
    }else{
      echo 'window.location.href="'.$url.'"';
    }
    echo '</script>';
    die;
}
//分页



//插入
function insert($table,$data){
	$sql="INSERT INTO  `$table`";
	$sql.= "(`".implode('`,`' ,array_keys($data))."`) VALUES ";
	$sql.= "('".implode("','",$data)."');";	
	return $sql;
}


//上传文件

function uploads($name='img',$path='uploads',$size=10485760,$arr=array('jpg','png','gif')){
		$num= $_FILES[$name]['error'];
		if($num>0){
			if($num==1){
				return '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。';
				
			}else if($num==2){
				return '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。';
			}else if($num==3){
				return '文件只有部分被上传。 ';
				
			}else if($num==4){
				return '没有文件被上传';
				
			}else{
				return '其他情况';
			
			}		
		}
		// 再次拦截
		 if($_FILES[$name]['size']>$size){
			return '你是故意的';
		 }
		 
		  //文件后缀名
		 $pre=pathinfo($_FILES[$name]['name'],PATHINFO_EXTENSION);

		 // echo $pre;
		
		  if(!in_array($pre,$arr)){
			return '文件的类型不对';
		  }
		//文件名跟文件后缀需要重新处理
		$filename=date('Ymdhis').mt_rand(1000,9999).'.'.$pre;
		
		  //判断是否是通过http post上传过来的文件
		 if(is_uploaded_file($_FILES[$name]['tmp_name'])){
			move_uploaded_file($_FILES[$name]['tmp_name'],$path.'/'.$filename);
			return $filename;
		  }else{
			return '你又是故意的';
		  }
}	
/**
 *	@param	string $table 表名
 *	@param	array  $update 需要修改的数据
 *	@param	string $condition 修改的条件
 */
function update($table,$update,$condition){
	global $conn;
	$sql="UPDATE `$table` SET ";
	
	foreach($update as $k=>$v){
		
		$sql.="`$k`='$v',";
	}
	$sql= rtrim($sql,",");
	
	$sql.=' WHERE '.$condition;
	return $sql;
}

//---------------删除--------------------------
function delete($table,$condition){
    $sql="DELETE FROM $table WHERE $condition";
     return $sql;
}
//得到当前网址
function get_url(){
	$str=$_SERVER['PHP_SELF'].'?';
	if($_GET){
		foreach ($_GET as $k=>$v){  //$_GET['page']
			if($k!='page'){
				$str .= $k.'='.$v.'&';
			}
		}
	}
	return $str;
}

/*
	
	[1]  2   3   4     5
	 1  [2]  3   4     5   要求显示五页，但是没有这么多数据，就只能按照总页数来排
	


	 1   2  [3]  4     5	 
     2   3  [4]  5     6
     3   4  [5]  6     7
     4   5  [6]  7	   8
     5   6  [7]	 8     9
	   
     6   7	[8]  9     10
	 

     6   7	 8  [9]    10
     6   7	 8   9     [10]
		
	
	$pages   5

	$pages-5+1;
*/


//分页函数
/**
 *@pargam $current	当前页
 *@pargam $count	记录总数
 *@pargam $limit	每页显示多少条
 *@pargam $size		中间显示多少条
 *@pargam $class	样式
*/
function page($current,$count,$limit,$size,$class='sabrosus'){
	$str='';
	if($count>$limit){
		$pages = ceil($count/$limit);//算出总页数
		$url = self::get_url();//获取当前页面的URL地址（包含参数）
		
		$str.='<div class="'.$class.'">';
		//开始
		if($current==1){
			$str.='<span class="disabled">首&nbsp;&nbsp;页</span>';
			$str.='<span class="disabled">  &lt;上一页 </span>';
		}else{
			$str.='<a href="'.$url.'page=1">首&nbsp;&nbsp;页 </a>';
			$str.='<a href="'.$url.'page='.($current-1).'">  &lt;上一页 </a>';
		}
		//中间
		//判断得出star与end
	    
		 if($current<=floor($size/2)){ //情况1
			$star=1;
			$end=$pages >$size ? $size : $pages; //看看他两谁小，取谁的
		 }else if($current>=$pages - floor($size/2)){ // 情况2
				 
			$star=$pages-$size+1<=0?1:$pages-$size+1; //避免出现负数
			
			$end=$pages;
		 }else{ //情况3
		 
			$d=floor($size/2);
			$star=$current-$d;
			$end=$current+$d;
		 }
	
		for($i=$star;$i<=$end;$i++){
			if($i==$current){
				$str.='<span class="current">'.$i.'</span>';	
			}else{
				$str.='<a href="'.$url.'page='.$i.'">'.$i.'</a>';
			}
		}
		//最后
		if($pages==$current){
			$str .='<span class="disabled">  下一页&gt; </span>';
			$str.='<span class="disabled">尾&nbsp;&nbsp;页  </span>';
		}else{
			$str.='<a href="'.$url.'page='.($current+1).'">下一页&gt; </a>';
			$str.='<a href="'.$url.'page='.$pages.'">尾&nbsp;&nbsp;页 </a>';
		}
		$str.='</div>';
	}
	
	return $str;
}
	/*
	 *创建缩略图
	 */
	function make_thumb($src, $dest, $desired_width) {

	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
	}

}