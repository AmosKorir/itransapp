<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{	if($id=$this->session->userdata('id')==='0'){
		redirect('Welcome/loginpage');
	}
		
		$this->main();
	}

	//function logout
	public function logout(){
		$this->session->set_userdata("id",'0');
		
		if($id=$this->session->userdata('id')==='0'){
			redirect('Welcome/loginpage');
		}
		
	}

	//method to load the main method

	public function main(){
		if($id=$this->session->userdata('id')==='0'){
			redirect('Welcome/loginpage');
		}
		$result=array();
		$result=$this->ReturnModel->gettransaction();
		$loan=array();
		$loan=$this->ReturnModel->getLoanRequest();
		$totalmembers=$this->ReturnModel->countMembers();
		$totalloan=$this->ReturnModel->totalloan();
		$totalcontribution=$this->ReturnModel->totalcontribution();

		$container= array('transaction'=>$result,
		'totalmembers'=>$totalmembers,
		'totalcontribution'=>$totalcontribution,
		'totalloan'=>$totalloan,
		'loanrequest'=>$loan);

		$this->load->view('header',$container);
		$this->load->view('main');
			
	}
	//function for the contribution page
	public function contributionpage(){
		if($id=$this->session->userdata('id')==='0'){
			redirect('Welcome/loginpage');
		}
		
		$result=$this->ReturnModel->gettransaction();
		$container= array('transaction'=>$result);
		

		$this->load->view('header');
		$this->load->view('addcontribution',$container);
	}
	//function to delete the contribution
	public function deletecontribution($id){
		$this->ReturnModel->deleteContribution($id);
		redirect('Welcome/contributionpage');
	}

	//function for registration

	public function registerpage(){
		$this->load->view('emptyhead');
		$this->load->view('register');
	}

	public function loginpage(){
		$this->load->view('emptyhead');
		$this->load->view('login');
	}

	//repay loan page
	public function repayloan(){
		if($id=$this->session->userdata('id')==='0'){
			redirect('Welcome/loginpage');
		}
		$result=$this->ReturnModel->getLoan();
		$container= array('transaction'=>$result);
		
		$this->load->view('header');
		$this->load->view('repayloan',$container);
		}
		public function payer(){
		$nationalid=$this->input->post('id');
		$amount=$this->input->post('amount');
		$this->ReturnModel->repayloan($nationalid,$amount);
		
		redirect('Welcome/repayloan');
		}

	//function membership
	public function membership(){
		if($id=$this->session->userdata('id')==='0'){
			redirect('Welcome/loginpage');
		}
		$members=$this->ReturnModel->members();
		$data=array('members'=>$members);
		$this->load->view('header');
		$this->load->view('addmember',$data);
	}


	//function to login a user

	public function loginUser(){
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('password','Password','required');

		$data=$this->Auth_Model->get_user();
      
		if (!empty($data)) {
		$this->session->set_userdata("userdetails",$data);
		$userid=$data['id'];
		
		$this->session->set_userdata("id",$userid);
		
			
		redirect('Welcome/main');			 
		
		}else{
			redirect('Welcome/loginpage');
		}
		  

	}

	//function to rester user
	public function registerUser(){
		$this->form_validation->set_rules('name','name','required');
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirmpassword','confirmpassword','required');
		$this->form_validation->run();
		
		if($this->input->post('password')===$this->input->post('confirmpassword')){
			
			$data=$this->Auth_Model->get_user();
		   if (!empty($data)) {
			
				
		   redirect('Welcome/loginpage');			 
		
		   }else{

			$this->Auth_Model->insert_user();
			redirect('Welcome/loginpage');	
		   }

		}else{
			// $this->load->view('header');
			// $this->load->view('register');
			


		}

		
		  


	}

	//function to add the user
	public function addmember(){
		$this->form_validation->set_rules('name','name','required');
		$this->form_validation->set_rules('id','id','required');
		$this->form_validation->set_rules('phone','phone','required');
		
		if ($this->form_validation->run() == FALSE)
                {
                }
                else
                {
					$this->Auth_Model->insertmember();
                }
		
		redirect('Welcome/membership');
	}

	//function to delete the member
	public function deletemember($nationalid){
		$this->ReturnModel->deleteMember($nationalid);
		redirect('Welcome/membership');
	}

	//work on the transaction from here

	public function addcontribution(){
		$this->form_validation->set_rules('id','id','required');
		$this->form_validation->set_rules('amount','amount','required');

		$this->Auth_Model->addcontribution();

		redirect('Welcome/contributionpage');
		

	}


	//function to accept the loan
	public function acceptloan($loanid,$amount,$memberid,$duedate){
		$this->ReturnModel->acceptloan($loanid ,$memberid,$amount,$duedate);
	 redirect('Welcome/main');

	}
	//function to decline loan
	public function declineloan($id){
		$this->ReturnModel->decline($id);
		redirect('Welcome/main');
	}
	

	


































	//function to return the current busses

	// function to get the buses default
	public function getBusDefault(){
		$result=$this->ItransModel->getBusDefault();
		echo json_encode($result);	
	}
	

	public function currentBuses($selectFrom,$selectTo,$selectTime){
		$result=$this->ItransModel->getBuses($selectFrom,$selectTo,$selectTime);
		echo json_encode($result);
	
		}
	//function to the customer bookings get the customer bookings
	 

	public function historyBooking($userid){
		$result=$this->ItransModel->customerBooking($userid);
		echo json_encode($result);
	}

	// function to get customer current balance

	public function currentBalance($userid){
	$balance=$this->ItransModel->customerBalance($userid);
	echo $balance;
	}

	//function get the customer

	public function user($userid){
		$result=$this->ItransModel->getCustomer($userid);
		
		echo json_encode($result);
	}

	//function to Auth
	public function auth($phone,$pass){
	
    	$r=$this->ItransModel->getUser($phone,$pass);
		$num=sizeof($r);
		if($num>0){
			$id;
			foreach($r as $row){
				$id=$row['id'];
				
			}

			
			echo $id;
			
		}else{
			echo"no";
		}
		
	}
	 

	
	

	//function to create the user 
	public function createUser($phone,$username,$password,$email){
		$this->ItransModel->insertUser($username,$password,$email,$phone);
		
	}
	 

	/*********function to book a bus****************/
	/******************************************** */

	
	public function bookBus($allocationid,$customerid,$numberSeats,$amount,$date){
		//first the check if the bus exist
		$this->ItransModel->checkBusallocation($allocationid,$customerid,$amount,$numberSeats,$date);
	}

	//function to cancel a bus

	public function cancelBook($tickecode,$allocationid,$userid,$amount,$nseat,$date){
		$result=$this->ItransModel->cancelBook($tickecode,$allocationid,$userid,$amount,$nseat,$date);
		echo $result;
	}

	//function to get StationA
	public function getStationA(){
		$result=$this->ItransModel->getStationA();
		echo json_encode($result);
	}
	//function to get StationB
	public function getStationB(){
		$result=$this->ItransModel->getStationB();
		echo json_encode($result);
	}

	//function to get the start time
	public function getTime(){
		$result=$this->ItransModel->getTime();
		echo json_encode($result);
	}

	
}
