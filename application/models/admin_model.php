<?php
	class Admin_model extends CI_Model{
		
		public function __construct(){
			$this->load->database();
		}

		public function login($username){
			$query = $this->db->get_where('admin', array('username' => $username));
			return $query->row_array();
		}

		public function deleteMsg($PID){
			$this->db->delete('post', array('PID' => $PID));
			$this->db->delete('reply', array('PID' => $PID));
		}
	}
?>