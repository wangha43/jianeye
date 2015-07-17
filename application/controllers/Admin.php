<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->library('myclass');
		$this->load->library('MY_Input');
		$this->load->database();
		session_start();
	}
	public function login() {
		if ($_POST) {
			$user = trim($_POST['username']);
			$pwd = md5($_POST['password']);
			$imgcode = trim($_POST['imgcode']);
			if ($imgcode != $_SESSION['imgcode']) {
				$this->myclass->show_msg('验证码错误!');
			}
			if ($user == '') {
				$this->myclass->show_msg('用户名不能为空');
			}
			$this->load->model('admin_');
			$res = $this->admin_->login($user, $pwd);
			if ($res) {
				$_SESSION['is_login'] = 1;
				$_SESSION['admin_user'] = $res[0]->user;
				$_SESSION['admin_id'] = $res[0]->id;
				redirect("admin/index");
			} else {
				$this->myclass->show_msg('用户名或密码错误!');
			}
		}
		$this->load->view("admin/login");
	}
	public function imgcode() {
		header('Content-type:image/jpeg');
		error_reporting(E_ALL);
		$str = self::verify(120, 30, 4);
		$_SESSION['imgcode'] = $str;
	}
	public function index() {
		self::pass_verify();
		$this->load->view("admin/index");
	}
	public function top() {
		self::pass_verify();
		$this->load->view("admin/top");
	}
	public function menu() {
		self::pass_verify();
		$this->load->view("admin/menu");
	}
	public function sys_info() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$data['conn'] = mysqli_connect($this->db->hostname, $this->db->username, $this->db->password);
			$this->load->view("admin/sys_info", $data);
		}
	}

	public function news_list() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$size = ($page - 1) * $limit;
			$sql = "select a.*,c.module,c.colum from `article_content` a left join `column` c on a.cid=c.id where c.module='资讯中心' order by time asc limit $size,$limit";
			$data["news"] = $this->db->query($sql)->result();
			$sql = "select count(id) as c from `article_content` where cid in (select id from `column` where `module`='资讯中心') ";
			$data["count"] = $this->db->query($sql)->result();
			$data["pagination"] = $this->myclass->page($page, $data["count"][0]->c, $limit, 5);
			if ($_POST) {
				$del = $_POST['del'];
				$str = implode(',', $del);
				$res = $this->myclass->delete('article_content', "id IN ($str)");
				if ($this->db->query($res)) {
					$this->myclass->show_msg('删除成功');
				} else {
					//show_msg('删除失败');
				}
			}
			$this->load->view("admin/news/list", $data);
		}
	}

	public function news_add() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$sql = "SELECT `colum`,`id` FROM `column` where `module`='资讯中心'";
			$data['col'] = $this->db->query($sql)->result();
			if ($_POST) {
				$data = array();
				$data['title'] = $_POST['title'];
				$data['cid'] = $_POST['cid'];
				$data['content'] = $_POST['content'];
				$data['time'] = strtotime($_POST['time']);
				$res = $this->myclass->insert('article_content', $data);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('文章添加成功');
				} else {
					//show_msg('失败!');
				}
			}
			$this->load->view("admin/news/add", $data);
		}
	}

	public function news_edit() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$sql = "SELECT `colum`,`id` FROM `column`";
			$data['col'] = $this->db->query($sql)->result();
			if (empty($_GET['id'])) {
				$this->myclass->show_msg('参数错误', 'news_list');
			}
			$id = $_GET['id'];
			$sql = "select * from `article_content` where id=" . "$id";
			$data['detail'] = $this->db->query($sql)->result();
			$data['id'] = $id;
			if ($_POST) {
				$data = array();
				$data['title'] = $_POST['title'];
				$data['cid'] = $_POST['cid'];
				$data['content'] = $_POST['content'];
				$data['time'] = strtotime($_POST['time']);
				$res = $this->myclass->update('article_content', $data, 'id=' . $id);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('文章编辑成功');
				} else {
					//show_msg('失败!');
				}
			}
			$this->load->view("admin/news_edit", $data);
		}
	}
	/*
	 *轮播图设置
	 */
	public function image_turn_list() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$size = ($page - 1) * $limit;
			$sql = "select * from `image_turn` order by time desc limit $size,$limit";
			$data["images"] = $this->db->query($sql)->result();
			$sql = "select count(id) as c from `image_turn`";
			$data["count"] = $this->db->query($sql)->result();
			$data["pagination"] = $this->myclass->page($page, $data["count"][0]->c, $limit, 5);
			if ($_POST) {
				$del = $_POST['del'];
				$str = implode(',', $del);
				$res = $this->myclass->delete('image_turn', "id IN ($str)");
				if ($this->db->query($res)) {
					$this->myclass->show_msg('删除成功');
				} else {
					//show_msg('删除失败');
				}
			}
			$this->load->view("admin/image_turn_list", $data);
		}
	}
	public function image_turn_edit() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			if (empty($_GET['id'])) {
				$this->myclass->show_msg('参数错误', 'image_turn_list');
			}
			$id = $_GET['id'];
			$sql = "select * from `image_turn` where id=" . "$id";
			$data['image'] = $this->db->query($sql)->result();
			$data['id'] = $id;
			if ($_POST) {
				//配置上传文件
				$update['url'] = $this->myclass->uploads('f', './uploadfile/images');
				$this->myclass->make_thumb('./uploadfile/images/' . $update['url'], './uploadfile/images/thumb/' . $update['url'], 104);
				$update['title'] = $_POST['title'];
				$update['describ'] = $_POST['describ'];
				$update['time'] = strtotime($_POST['time']);
				$res = $this->myclass->update('image_turn', $update, 'id=' . $id);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('图片修改成功');
				} else {
					$this->myclass->show_msg('失败!');
				}
			}
			$this->load->view("admin/image_turn_edit", $data);
		}
	}

	public function image_turn_add() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			if ($_POST) {
				//配置上传文件
				$insert['url'] = $this->myclass->uploads('f', './uploadfile/images');
				$this->myclass->make_thumb('./uploadfile/images/' . $insert['url'], './uploadfile/images/thumb/' . $insert['url'], 104);
				$insert['title'] = $_POST['title'];
				$insert['describ'] = $_POST['describ'];
				$insert['time'] = strtotime($_POST['time']);
				$res = $this->myclass->insert('image_turn', $insert);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('图片添加成功');
					redirect();
				} else {
					$this->myclass->show_msg('失败!');
				}
			}
			$this->load->view("admin/image_turn_add");
		}
	}
	public function admin_list() {
		echo "root";
	}

	public function log_out() {
		session_destroy();
		redirect("admin/login");
	}

	public function about_us() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$size = ($page - 1) * $limit;
			$sql = "select a.*,c.module,c.colum from `article_content` a left join `column` c on a.cid=c.id where c.module='关于我们' order by time asc limit $size,$limit";
			$data["news"] = $this->db->query($sql)->result();
			$sql = "select count(id) as c from `article_content` where cid in (select id from `column` where `module`='关于我们') ";
			$data["count"] = $this->db->query($sql)->result();
			$data["pagination"] = $this->myclass->page($page, $data["count"][0]->c, $limit, 5);
			if ($_POST) {
				$del = $_POST['del'];
				$str = implode(',', $del);
				$res = $this->myclass->delete('article_content', "id IN ($str)");
				if ($this->db->query($res)) {
					$this->myclass->show_msg('删除成功');
				} else {
					//show_msg('删除失败');
				}
			}
			$this->load->view("admin/about_us/list", $data);
		}
	}

	public function about_us_add() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$sql = "SELECT `colum`,`id` FROM `column` where `module`='关于我们'";
			$data['col'] = $this->db->query($sql)->result();
			if ($_POST) {
				$data = array();
				$data['title'] = $_POST['title'];
				$data['cid'] = $_POST['cid'];
				$data['content'] = $_POST['content'];
				$data['time'] = strtotime($_POST['time']);
				$res = $this->myclass->insert('article_content', $data);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('文章添加成功');
				} else {
					//show_msg('失败!');
				}
			}
			$this->load->view("admin/about_us/add", $data);
		}
	}

	public function pro_list() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$size = ($page - 1) * $limit;
			$sql = "select a.*,c.module,c.colum from `article_content` a left join `column` c on a.cid=c.id where c.module='产品中心' order by time asc limit $size,$limit";
			$data["news"] = $this->db->query($sql)->result();
			$sql = "select count(id) as c from `article_content` where cid in (select id from `column` where `module`='产品中心') ";
			$data["count"] = $this->db->query($sql)->result();
			$data["pagination"] = $this->myclass->page($page, $data["count"][0]->c, $limit, 5);
			if ($_POST) {
				$del = $_POST['del'];
				$str = implode(',', $del);
				$res = $this->myclass->delete('article_content', "id IN ($str)");
				if ($this->db->query($res)) {
					$this->myclass->show_msg('删除成功');
				} else {
					//show_msg('删除失败');
				}
			}
			$this->load->view("admin/pro/list", $data);
		}
	}

	public function pro_list_add() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$sql = "SELECT `colum`,`id` FROM `column` where `module`='产品中心'";
			$data['col'] = $this->db->query($sql)->result();
			if ($_POST) {
				$data = array();
				$data['title'] = $_POST['title'];
				$data['cid'] = $_POST['cid'];
				$data['content'] = $_POST['content'];
				$data['time'] = strtotime($_POST['time']);
				$res = $this->myclass->insert('article_content', $data);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('文章添加成功');
				} else {
					//show_msg('失败!');
				}
			}
			$this->load->view("admin/pro/add", $data);
		}
	}
	public function sol_list() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$size = ($page - 1) * $limit;
			$sql = "select a.*,c.module,c.colum from `article_content` a left join `column` c on a.cid=c.id where c.module='解决方案' order by time asc limit $size,$limit";
			$data["news"] = $this->db->query($sql)->result();
			$sql = "select count(id) as c from `article_content` where cid in (select id from `column` where `module`='解决方案') ";
			$data["count"] = $this->db->query($sql)->result();
			$data["pagination"] = $this->myclass->page($page, $data["count"][0]->c, $limit, 5);
			if ($_POST) {
				$del = $_POST['del'];
				$str = implode(',', $del);
				$res = $this->myclass->delete('article_content', "id IN ($str)");
				if ($this->db->query($res)) {
					$this->myclass->show_msg('删除成功');
				} else {
					//show_msg('删除失败');
				}
			}
			$this->load->view("admin/sol/list", $data);
		}
	}

	public function sol_list_add() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$sql = "SELECT `colum`,`id` FROM `column` where `module`='解决方案'";
			$data['col'] = $this->db->query($sql)->result();
			if ($_POST) {
				$data = array();
				$data['title'] = $_POST['title'];
				$data['cid'] = $_POST['cid'];
				$data['content'] = $_POST['content'];
				$data['time'] = strtotime($_POST['time']);
				$res = $this->myclass->insert('article_content', $data);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('文章添加成功');
				} else {
					//show_msg('失败!');
				}
			}
			$this->load->view("admin/sol/add", $data);
		}
	}
	public function engn_list() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$size = ($page - 1) * $limit;
			$sql = "select a.*,c.module,c.colum from `article_content` a left join `column` c on a.cid=c.id where c.module='工程案例' order by time asc limit $size,$limit";
			$data["news"] = $this->db->query($sql)->result();
			$sql = "select count(id) as c from `article_content` where cid in (select id from `column` where `module`='工程案例') ";
			$data["count"] = $this->db->query($sql)->result();
			$data["pagination"] = $this->myclass->page($page, $data["count"][0]->c, $limit, 5);
			if ($_POST) {
				$del = $_POST['del'];
				$str = implode(',', $del);
				$res = $this->myclass->delete('article_content', "id IN ($str)");
				if ($this->db->query($res)) {
					$this->myclass->show_msg('删除成功');
				} else {
					//show_msg('删除失败');
				}
			}
			$this->load->view("admin/engn/list", $data);
		}
	}

	public function engn_list_add() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$sql = "SELECT `colum`,`id` FROM `column` where `module`='工程案例'";
			$data['col'] = $this->db->query($sql)->result();
			if ($_POST) {
				$data = array();
				$data['title'] = $_POST['title'];
				$data['cid'] = $_POST['cid'];
				$data['content'] = $_POST['content'];
				$data['time'] = strtotime($_POST['time']);
				$res = $this->myclass->insert('article_content', $data);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('文章添加成功');
				} else {
					//show_msg('失败!');
				}
			}
			$this->load->view("admin/engn/add", $data);
		}
	}
	public function pre_list() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$size = ($page - 1) * $limit;
			$sql = "select a.*,c.module,c.colum from `article_content` a left join `column` c on a.cid=c.id where c.module='优惠套餐' order by time asc limit $size,$limit";
			$data["news"] = $this->db->query($sql)->result();
			$sql = "select count(id) as c from `article_content` where cid in (select id from `column` where `module`='优惠套餐') ";
			$data["count"] = $this->db->query($sql)->result();
			$data["pagination"] = $this->myclass->page($page, $data["count"][0]->c, $limit, 5);
			if ($_POST) {
				$del = $_POST['del'];
				$str = implode(',', $del);
				$res = $this->myclass->delete('article_content', "id IN ($str)");
				if ($this->db->query($res)) {
					$this->myclass->show_msg('删除成功');
				} else {
					//show_msg('删除失败');
				}
			}
			$this->load->view("admin/pre/list", $data);
		}
	}

	public function pre_list_add() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$sql = "SELECT `colum`,`id` FROM `column` where `module`='优惠套餐'";
			$data['col'] = $this->db->query($sql)->result();
			if ($_POST) {
				$data = array();
				$data['title'] = $_POST['title'];
				$data['cid'] = $_POST['cid'];
				$data['content'] = $_POST['content'];
				$data['time'] = strtotime($_POST['time']);
				$res = $this->myclass->insert('article_content', $data);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('文章添加成功');
				} else {
					//show_msg('失败!');
				}
			}
			$this->load->view("admin/pre/add", $data);
		}
	}
	public function jianeye_list() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$size = ($page - 1) * $limit;
			$sql = "select a.*,c.module,c.colum from `article_content` a left join `column` c on a.cid=c.id where c.module='戬智眼课堂' order by time asc limit $size,$limit";
			$data["news"] = $this->db->query($sql)->result();
			$sql = "select count(id) as c from `article_content` where cid in (select id from `column` where `module`='戬智眼课堂') ";
			$data["count"] = $this->db->query($sql)->result();
			$data["pagination"] = $this->myclass->page($page, $data["count"][0]->c, $limit, 5);
			if ($_POST) {
				$del = $_POST['del'];
				$str = implode(',', $del);
				$res = $this->myclass->delete('article_content', "id IN ($str)");
				if ($this->db->query($res)) {
					$this->myclass->show_msg('删除成功');
				} else {
					//show_msg('删除失败');
				}
			}
			$this->load->view("admin/jianeye/list", $data);
		}
	}

	public function jianeye_list_add() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login");
		} else {
			$sql = "SELECT `colum`,`id` FROM `column` where `module`='戬智眼课堂'";
			$data['col'] = $this->db->query($sql)->result();
			if ($_POST) {
				$data = array();
				$data['title'] = $_POST['title'];
				$data['cid'] = $_POST['cid'];
				$data['content'] = $_POST['content'];
				$data['time'] = strtotime($_POST['time']);
				$res = $this->myclass->insert('article_content', $data);
				if ($this->db->query($res)) {
					$this->myclass->show_msg('文章添加成功');
				} else {
					//show_msg('失败!');
				}
			}
			$this->load->view("admin/jianeye/add", $data);
		}
	}

	private function pass_verify() {
		if ($_SESSION['is_login'] != 1) {
			redirect("admin/login", "refresh");
		}
	}
	private function verify($width, $height, $codeLen) {
		#定义一个画布
		$image = imagecreatetruecolor($width, $height);
		#定义颜色
		$black = imagecolorallocate($image, 0, 0, 0);
		$white = imagecolorallocate($image, 255, 255, 255);
		$blue = imagecolorallocate($image, 0, 0, 255);
		#画一个矩形
		imagefilledrectangle($image, 0, 0, $width, $height, $blue);
		#往图片内写入字符
		$key = '23456789qwertyuipasdfghjkzxcvbnm';
		$len = strlen($key);
		$string = $codeStr = '';
		$size = 20;
		$baseY = ($height - $size) / 2 + $size - 2;
		// putenv('GDFONTPATH=' . realpath('.'));
		$fontfile = __DIR__ . '/FZSTK.TTF';
		for ($i = 0; $i < $codeLen; $i++) {
			$num = rand(1, $len) - 1;
			$string = $key[$num];
			$codeStr .= $string;
			$x = ($width / $codeLen) * $i + 10;
			$angle = mt_rand(-45, 45);
			imagettftext($image, $size, $angle, $x, $baseY, $white, $fontfile, $string);
		}

		imagesetthickness($image, 2);

		//干扰点
		for ($i = 1; $i <= 20; $i++) {
			imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)));
		}

		//干扰线

		for ($i = 1; $i <= 1; $i++) {

			imageline($image, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)));

		}

		#输出图片
		imagejpeg($image);
		#验证码字符串，会在后期：会话控制或Ajax时使用到
		return $codeStr;
	}
}