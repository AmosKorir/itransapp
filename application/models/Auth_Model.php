<?php
defined('BASEPATH')OR exit('No direct script access allowed');
class Auth_Model extends CI_Model{


	//function to authenicate
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
		$query = $this->db->get_where('email', array('email' =>$this->input->post('email')));
     
       return $query->result_array();
	}
	//function to get the current session id,
	public function currentid(){

		$id=$this->session->userdata('id');
		
	
	
		return $id;
	}

	//function create the user
	public function insert_user(){
		 $data = array('id' =>$this->input->post(''),
		 	'email'=>$this->input->post('email'),
		 	'groupname'=>$this->input->post('name'),
		 	'email'=>$this->input->post('email'),		 	
		 	'password'=>$this->input->post('password'));
		     return $this->db->insert('chama',$data);
	}

	//function to add the user
	public function insertmember(){
		$data=array(
		'nationalid'=>$this->input->post('id'),
		'name'=>$this->input->post('name'),
		'groupid'=>$this->currentid(),
		'phone'=>$this->input->post('phone')
	);
	return $this->db->insert('members',$data);
	}









//transaction section 


//function to add the contributtion
public function addcontribution(){
	$amount=$this->input->post('amount');
	$id=$this->input->post('id');
	$date=date('Y-m-d');
	$groupid=$this->currentid();
	
	$data=array(
		'amount'=>$amount,
		'groupid'=>$groupid,
		'date'=>$date,
		'memberid'=>$id
	);
	$this->db->insert('contribution',$data);
	

}

//function to award loan
public function awardloan($nationalid,$amount,$paydate){
    //check if the user exist in the loan list;
    $groupid=$this->session->user_data('id');
    $this->db-select('nationalid');
    $this->db->from('members');
    $this->db->where('nationalid',$nationid);
    $result=$this->get();
    $result=$result->result_array();
    $count=sizeof($result);
    if($count===0){
        $data=array(
            'nationalid'=>$nationalid,
            'duedate'=>$paydate,
            'groupid'=>$groupid,
            'amount'=>$amount
        );
        $this->db->insert('loan',$data);
    }

    //to continue with this function 


}


















}
?>