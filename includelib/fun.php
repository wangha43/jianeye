<?php

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
function str_cut(&$string, $start, $length, $charset = "utf-8", $dot = '...') {
	if (function_exists('mb_substr')) {
		if (mb_strlen($string, $charset) > $length) {
			return mb_substr($string, $start, $length, $charset) . $dot;
		}
		return mb_substr($string, $start, $length, $charset);

	} else if (function_exists('iconv_substr')) {
		if (iconv_strlen($string, $charset) > $length) {
			return iconv_substr($string, $start, $length, $charset) . $dot;
		}
		return iconv_substr($string, $start, $length, $charset);
	}

	$charset = strtolower($charset);
	switch ($charset) {
	case "utf-8":
		preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $ar);
		if (func_num_args() >= 3) {
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
		$length = $length * 2;
		$strlen = strlen($string);
		for ($i = 0; $i < $strlen; $i++) {
			if ($i >= $start && $i < ($start + $length)) {
				if (ord(substr($string, $i, 1)) > 129) {
					$tmpstr .= substr($string, $i, 2);
				} else {
					$tmpstr .= substr($string, $i, 1);
				}

			}
			if (ord(substr($string, $i, 1)) > 129) {
				$i++;
			}

		}
		if (strlen($tmpstr) < $strlen) {
			$tmpstr .= $dot;
		}

		return $tmpstr;
	}
}

/**
 * @param $sql string sql语句
 * @return 一个二维的数组结果
 */
function get_all($sql, $conn) {
	$data = array();
	$res = mysqli_query($conn, $sql);
	if ($res && mysqli_num_rows($res)) {
		while ($tmp = mysqli_fetch_assoc($res)) {
			$data[] = $tmp;
		}
		mysqli_free_result($res); //释放结果集
	}
	return $data;
}

/**
 * 获取一行数据
 * @param string $sql
 * @return 一个一维数组
 */
function get_one($sql, $conn) {
	$data = array();
	$res = mysqli_query($conn, $sql);
	if ($res && mysqli_num_rows($res)) {
		$data = mysqli_fetch_assoc($res);
		mysqli_free_result($res); //释放结果集
	}
	return $data;
}

//提醒
function show_msg($msg, $url = '') {

	echo '<script>';
	echo 'alert("' . $msg . '");';
	if (empty($url)) {
		echo 'window.history.go(-1);';
	} else {
		echo 'window.location.href="' . $url . '"';
	}
	echo '</script>';
	die;
}

/**
 *	@param	string $table 表名
 *	@param	array  $data  插入表的数据
 *	@return	主键id
 */
function insert($table, $data, $conn) {
	$sql = "INSERT INTO  `$table`";
	$sql .= "(`" . implode('`,`', array_keys($data)) . "`) VALUES ";
	$sql .= "('" . implode("','", $data) . "');";
	echo $sql;
	mysqli_query($conn, $sql);

	return mysqli_insert_id($conn);
}

//得到当前网址
function get_url() {
	$str = $_SERVER['PHP_SELF'] . '?';
	if ($_GET) {
		foreach ($_GET as $k => $v) {
			//$_GET['page']
			if ($k != 'page') {
				$str .= $k . '=' . $v . '&';
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
function page($current, $count, $limit, $size, $class = 'paginate_button') {
	$str = '';
	if ($count > $limit) {
		$pages = ceil($count / $limit); //算出总页数
		$url = get_url(); //获取当前页面的URL地址（包含参数）

		$str .= '<div class="dataTables_paginate paging_simple_numbers" id="example-1_paginate"><ul class="pagination">';
		//开始
		if ($current == 1) {
			$str .= '<li class="disabled ' . $class . '"><a href="">首&nbsp;&nbsp;页</a></li>';
			$str .= '<li class="disabled ' . $class . '" > <a href=""> &lt;上一页</a> </li>';
		} else {
			$str .= '<li class="' . $class . '"><a href="' . $url . 'page=1">首&nbsp;&nbsp;页 </a></li>';
			$str .= '<li class="' . $class . '"><a href="' . $url . 'page=' . ($current - 1) . '">  &lt;上一页 </a></li>';
		}
		//中间
		//判断得出star与end

		if ($current <= floor($size / 2)) {
			//情况1
			$star = 1;
			$end = $pages > $size ? $size : $pages; //看看他两谁小，取谁的
		} else if ($current >= $pages - floor($size / 2)) {
			// 情况2

			$star = $pages - $size + 1 <= 0 ? 1 : $pages - $size + 1; //避免出现负数

			$end = $pages;
		} else {
			//情况3
			$d = floor($size / 2);
			$star = $current - $d;
			$end = $current + $d;
		}

		for ($i = $star; $i <= $end; $i++) {
			if ($i == $current) {
				$str .= '<li class="active ' . $class . '"><a href="' . $url . 'page=' . $i . '">' . $i . '</a></li>';
			} else {
				$str .= '<li class="' . $class . '"><a href="' . $url . 'page=' . $i . '">' . $i . '</a></li>';
			}
		}
		//最后
		if ($pages == $current) {
			$str .= '<li class="disabled ' . $class . '"> <a href=""> 下一页&gt; </a></li>';
			$str .= '<li class="disabled ' . $class . '"><a href=""> 尾&nbsp;&nbsp;页 </a></li>';
		} else {
			$str .= '<li class="' . $class . '"><a href="' . $url . 'page=' . ($current + 1) . '">下一页&gt; </a></li>';
			$str .= '<li class="' . $class . '"><a href="' . $url . 'page=' . $pages . '">尾&nbsp;&nbsp;页 </a></li>';
		}
		$str .= '</ul></div>';
	}
	return $str;
}

/*
 *获取所在月份的其实和终止的日期
 */
function getMonthRange($date) {
	$ret = array();
	$timestamp = strtotime($date);
	$mdays = date('t', $timestamp); //当月天数
	$ret['sdate'] = date('Ym01', $timestamp);
	$ret['edate'] = date('Ym' . $mdays, $timestamp);
	return $ret;
}

/*
 *
 *
 */
function getcolor($score) {
	if ($score > 300) {
		echo "red";
	} elseif ($score <= 300 && $score >= 260) {
		echo "orange";
	} elseif ($score <= 260 && $score >= 220) {
		echo "yellow";
	} elseif ($score <= 220 && $score >= 180) {
		echo "blue";
	} else {
		echo "green";
	}
}

function givestar($score) {
	$s = "";
	if ($score > 0) {
		for ($i = $score; $i >= 1; $i--) {
			$s .= "<img src='../images/fullstar.png' alt=''>";
		}
	}
	if (is_float($score)) {
		$s .= "<img src='../images/halfstar.png' alt=''>";

	}
	echo $s;
}