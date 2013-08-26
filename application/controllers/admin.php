<?php
	class Admin extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			$this->load->model('admin_model');
			$this->load->library('session');
			$this->load->helper('url');
		}

		private function checkLogin(){
			$loginFlag = $this->session->userdata('username');

			if($loginFlag){
				return $loginFlag;
			}else{
				die("你沒有操作的權限！");
			}
		}

		public function login(){
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if($username || $password){
				$loginData = $this->admin_model->login($username);

				if($loginData){

					if($loginData['password'] == $password){

						$this->session->set_userdata('username', $username);
						redirect('board');

					}else{
						echo "密碼錯誤！";
					}//end if($loginData['password']) == $password

				}else{
					echo '查無此帳號！';
				}//end if(loginData)

			}else{
				echo '你未輸入帳號或密碼！';
			}//end if($username || $password)
		}

		public function logout(){
			$this->checkLogin();

			$this->session->sess_destroy();	
			redirect('board');
		}

		public function deleteMsg($page = 1){
			$this->checkLogin();

			$PID = $this->input->post('delete');
			$this->admin_model->deleteMsg($PID);

			redirect('board/index/' . $page);
		}
	}
?>