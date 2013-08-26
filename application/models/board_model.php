<?php
	class Board_model extends CI_Model{
		
		private $viewItem = 20;
		private $dateFormat = "%Y-%m-%d %H:%i:%s";

		public function __construct(){
			$this->load->database();
			$this->load->helper('date');
		}

		public function getMsg($page){
			$start = ($page-1) * $this->viewItem;

			$this->db->limit($this->viewItem, $start);
			$this->db->order_by('PID', 'desc');
			$query = $this->db->get('post');

			return $query->result_array();
		}

		public function setMsg($msg){
			$data = array(
				'msg' => $msg,
				'datetime' => mdate($this->dateFormat, time())
			);

			return $this->db->insert('post', $data);
		}

		public function setReply($PID, $reply){
			$data = array(
				'PID' => $PID,
				'msg' => $reply,
				'datetime' => mdate($this->dateFormat, time())
			);

			return $this->db->insert('reply', $data);
		}

		public function getReply($PID){
			$this->db->where('PID', $PID);
			$this->db->order_by('PID', 'asc');
			$query = $this->db->get('reply');

			return $query->result_array();
		}
		
		public function getTotalPage($page){
			$postItem = $this->db->count_all('post');
			$totalPage = ceil($postItem/$this->viewItem);

			return $totalPage;
		}
	}
?>