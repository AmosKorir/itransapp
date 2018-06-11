<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	//function to return the current busses

	// function to get the buse default
	public function getBusDefault(){
		$result=$this->ItransModel->getBusDefault();
		echo json_encode($result);	
	}
	

	public function currentBuses($selectFrom,$selectTo,$selectTime){
		$result=$this->ItransModel->getBuses($selectFrom,$selectTo,$selectTime);
		echo json_encode($result);
	
		}
	//function to the customer booking 

	public function historyBooking($userid){
		$result=$this->ItransModel->customerBooking($userid);
		echo json_encode($result);
	}

	// function to get customer current balance

	public function currentBalance($userid){
		echo " your current balance 1200";
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

			
			$this->user($id);
		}else{
			echo"no";
		}
		
	}
	 

	
	

	//function to create the user 
	public function createUser($phone,$username,$password,$email){
		$this->ItransModel->insertUser($username,$email,$phone,$password);
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
