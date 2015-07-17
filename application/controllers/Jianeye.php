<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jianeye extends CI_Controller {

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
	}
	public function index() {
		// show_404();
		$this->load->model('Admin_');
		$data['image'] = $this->Admin_->index()->result();
		$data['col'] = $this->Admin_->column();
		$data['images'] = $this->db->query("select * from `image_turn`")->result();
		$this->load->view('jianeye/index', $data);
	}
	//about
	public function aboutus_introduct() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$data['slidebar'] = $this->admin_->get_mate(__FUNCTION__);
		// print_r($side);die();
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/aboutus/introduct/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function aboutus_culture() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$data['slidebar'] = $this->admin_->get_mate(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/aboutus/culture/index', $data);
		$this->load->view('jianeye/footer', $data);
		$this->output->cache(0.1);
	}
	public function about_service() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$data['slidebar'] = $this->admin_->get_mate(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/aboutus/service/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function about_contact() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/aboutus/contact/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function about_honor() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['slidebar'] = $this->admin_->get_mate(__FUNCTION__);
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/aboutus/honor/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	/*
	category/72/1.php">采暖系统</a>

	category/14/1.php">空调系统</a>

	category/17/1.php">净水热水</a>

	product/wind/dakin/index.htm"
	 *
	 */
	public function category_72() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/category/72/1', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function category_14() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/category/14/1', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function category_17() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/category/17/1', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function product_wind() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/product/wind/dakin/index', $data);
		$this->load->view('jianeye/footer', $data);
	}

	/*
	solution/temp/index.htm"
	solution/water/index.htm
	solution/air/index.htm">
	 */
	public function solution_temp() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/solution/temp/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function solution_water() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/solution/water/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function solution_air() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/solution/air/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	/*
	 *case/warm/index.htm">采暖系统</
	case/aircondition/index.htm
	case/water/index.htm">净水热水<
	case/wind/index.htm">新风除尘</
	 */
	public function case_warm() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/case/warm/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function case_aircondition() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/case/aircondition/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function case_water() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/case/water/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function case_wind() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/case/wind/index', $data);
		$this->load->view('jianeye/footer', $data);
	}

	/*
	news/company/index.htm">公司动态</
	news/workon/index.htm">行业新闻</a
	news/jingyingxiangmu/index.htm
	 */
	public function news_company() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/news/company/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function news_workon() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/news/workon/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function news_jingyingxiangmu() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/news/jingyingxiangmu/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	/*
	category/137/1.php">采暖套餐</a>

	package/zykttc/kt/glkt/index.htm"
	category/143/1.php">净水套餐</a>
	 **/
	public function category_137() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/category/137/1', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function package_zykttc() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/package/zykttc/kt/glkt/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function category_143() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/category/143/1', $data);
		$this->load->view('jianeye/footer', $data);
	}

	/*
	learn/buy/warm/index.htm">选
	learn/struct/warm/index.htm
	learn/using/warm/index.htm"
	learn/protect/warm/index.ht
	 */
	public function learn_buy() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/learn/buy/warm/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function learn_struct() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/learn/struct/warm/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function learn_using() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/learn/using/warm/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
	public function learn_protect() {
		$this->load->model('admin_');
		$data['image'] = $this->admin_->index()->result();
		$data['col'] = $this->admin_->column();
		$data['article'] = $this->admin_->getarticle(__FUNCTION__);
		$this->load->view('jianeye/header', $data);
		$this->load->view('jianeye/learn/protect/warm/index', $data);
		$this->load->view('jianeye/footer', $data);
	}
}
