<?php
defined('BASEPATH')OR exit('No direct script access allowed');
class auth_model extends CI_Model{


	//function to authenicate
	public function get_user(){
		$pwd=md5($this->input->post('password'));
		$pwd=$this->input->post('password');
		 $query = $this->db->get_where('chama', array('email' =>$this->input->post('email'),'password'=>
		 	$pwd));
     
     		 return $query->row_array();
	}
	//function find user id
	public function user_exist(){
		$query = $this->db->get_where('chama', array('email' =>$this->input->post('email')));
     
     		 return $query->result_array();
	}
	//function create the user
	public function insert_user(){
		 $data = array('userid' =>$this->input->post(''),
		 	'firstname'=>$this->input->post('firstname'),
		 	'lastname'=>$this->input->post('lastname'),
		 	'username'=>$this->input->post('email'),
		 	'phone'=>$this->input->post('phone'),
		 	'password'=>md5($this->input->post('password')));
		 return $this->db->insert('userlogin',$data);
	}
}
?>