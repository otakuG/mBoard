<?php
	class Board extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			$this->load->model('board_model');
			$this->load->helper('url');
			$this->load->library('typography');
			$this->load->library('session');
		}

		public function index($page = 1){

			//判斷是否登入
			$loginFlag = $this->session->userdata('username');

			//取得該頁面的留言。
			$data['msg'] = $this->board_model->getMsg($page);

			//目前所在的頁數。
			$data['page'] = $page;

			//取得總頁數。
			$data['totalPage'] = $this->board_model->getTotalPage($page);

			//取得留言的回覆，並寫入到到$data['msg']中。
			foreach($data['msg'] as $index => $msgItem){
				$data['msg'][$index]['reply'] = $this->board_model->getReply($msgItem['PID']);
			}

			//載入css樣板
			$data['bootstrapPath'] = base_url('public/css/bootstrap.css');
			$data['customPath'] = base_url('public/css/custom.css');

			//載入版面
			$this->load->view('templates/head', $data);

			if($loginFlag){
				$this->load->view('templates/nav_login', $data);
				$this->load->view('board_login', $data);
			}else{
				$this->load->view('templates/nav', $data);
				$this->load->view('board', $data);
			}

			$this->load->view('templates/footer', $data);
		}

		public function setMsg(){
			$msg = $this->input->post('msg');
			$msg = $this->typography->nl2br_except_pre($msg);

			if($msg){
				$this->board_model->setMsg($msg);
				redirect('board');
			}else{
				echo "你沒有輸入訊息！";
			}
		}

		public function setReply($page = 1){
			$PID = $this->input->post('PID');

			$reply = $this->input->post('reply');
			$reply = $this->typography->nl2br_except_pre($reply);

			if($reply){
				$this->board_model->setReply($PID, $reply);
				redirect('board/index/' . $page);
			}else{
				echo "你沒有輸入回覆！";
			}
		}
	}
?>