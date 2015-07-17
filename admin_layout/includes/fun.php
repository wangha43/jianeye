<?php
    
    /**
     * 函数库 
     * @author b1414工作室 <1414@qq.com>
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
	global $conn;
	$sql="INSERT INTO  `$table`";
	$sql.= "(`".implode('`,`' ,array_keys($data))."`) VALUES ";
	$sql.= "('".implode("','",$data)."');";
	echo $sql;
	mysql_query($sql,$conn);
	return mysql_insert_id($conn);
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

		 echo $pre;
		
		  if(!in_array($pre,$arr)){
			return '文件的类型不对';
		  }
		//文件名跟文件后缀需要重新处理
		$filename=date('Ymdhis').mt_rand(1000,9999).'.'.$pre;
		
		  //判断是否是通过http post上传过来的文件
		 if(is_uploaded_file($_FILES[$name]['tmp_name'])){
			move_uploaded_file($_FILES[$name]['tmp_name'],$path.'/'.$filename);
			return array($filename);
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
	echo $sql;
	mysql_query($sql);
	
	if(mysql_affected_rows($conn)>0){
		return 1;
	}else{
		return 0;
	}/**/
}

//---------------删除--------------------------
function delete($table,$condition){
    global $conn;
    $sql="DELETE FROM $table WHERE $condition";
   	echo $sql;
    /**/mysql_query($sql,$conn);

    if (mysql_affected_rows($conn)>0) {
        return 1;    
    }else{
        return 0;
    }
}
?>
