<?php
defined('BASEPATH')OR exit('No direct script access allowed');
class ItransModel extends CI_Model{

	function __construct(){
		$this->load->database();
	}

	
	//function to get the bus default
	public function getBusDefault(){
		///$query = $this->db->get_where('allocation', array('stationA' =>$origin,'stationB' =>$destination,'StartA' =>$time,));
		$this->db->select("*");
		$this->db->from("allocation");
		$this->db->join('bus','allocation.busid=bus.busid');
		$this->db->join('company','bus.companyid=company.companyid');
		$this->db->join('booking','booking.allocationid=allocation.id');
		$this->db->order_by("booking.seatsremaining", "asc");
		// $this->db->where( array('stationA' =>$origin,'stationB' =>$destination,'StartA' =>$time));
		$query=$this->db->get();
		$query=$query->result_array();
		return $query;

	}


    //function to fetch the buses

    public function getBuses($origin,$destination,$time){
		///$query = $this->db->get_where('allocation', array('stationA' =>$origin,'stationB' =>$destination,'StartA' =>$time,));
		$this->db->select("*");
		$this->db->from("allocation");
		$this->db->join('bus','allocation.busid=bus.busid');
		$this->db->join('company','bus.companyid=company.companyid');
		$this->db->where( array('stationA' =>$origin,'stationB' =>$destination,'StartA' =>$time));
		$query=$this->db->get();
		$query=$query->result_array();
		return $query;

	}
	//function to get stationA
	public function getStationA(){
		$this->db->select('allocation.stationA');
		$this->db->from('allocation');
		$result=$this->db->get();
		$result=$result->result_array();
		return $result;

	}
	//function to get stationB
	public function getStationB(){
		$this->db->select('allocation.StationB');
		$this->db->from('allocation');
		$result=$this->db->get();
		$result=$result->result_array();
		return $result;

	}

	//function to the time s fo r star 
	public function getTime(){
		$this->db->select('allocation.startA');
		$this->db->from('allocation');
		$result=$this->db->get();
		$result=$result->result_array();
		return $result;

	}






	/****************************************** */
	/******user functions********************** */
	/****************************************** */

	//function to get the details of the customer 

	public function getCustomer($userid){

		$query=$this->db->get_where('customer',array('customerid'=>$userid));
		$query=$query->result_array();
		return $query;
	}


//function to ge authenticate user
//function to authenicate
public function getUser($phone,$password){
	//$pwd=md5($this->input->post('password'));
	 $query = $this->db->get_where('customerlogin',array('phone'=>$phone,'password'=>$password));
     $query=$query->result_array();
	return $query;
 }

 //function to create a customer

 public function insertUser($username,$password,$email,$phone){
	$data=array(
		'password'=>$password,
		'username'=>$username,
		'email'=>$email,
		'phone'=>$phone,
		
	);

	 $this->db->insert('customerlogin',$data );
 }

 //function to get the user booking

 public function customerBooking($customerid){
	$this->db->select("*");
	$this->db->where(array("customerid"=>$customerid));
	$this->db->from('transaction');
	$this->db->join("allocation","allocation.id=transaction.allocationid");
	$this->db->order_by("date", "desc");
	$result=$this->db->get();
	$query=$result->result_array();
	return $query;

 }
 //return customer balance
 public function customerBalance($customerid){
	 $result=$this->getCustomer($customerid);
	 $balance;
	 foreach($result as $customer){
		$balance=$customer['wallet'];
	}
 
	return $balance;
 }

 //function to update user balance
 public function updateBalance($customerid,$type,$amount){
	$balance=$this->customerBalance($customerid);
	 if($type==="1"){
		 $balance=$balance-$amount;

	 }else{
		
		$balance=$balance+$amount;
	 }
	$this->db->set('wallet',$balance);
	$this->db->where(array("customerid"=>$customerid));
	$this->db->update('customer');
 }

 /****************************************** */
 /**************Bus section****************** */
 /******************************************* */

 //function to get the bus

 public function getBus($allocationid){
	 $this->db->select("*");
	 $this->db->from("allocation");
	//  $this->db->join("allocation",'allocation.id=booking.allocationid');
	 $this->db->join("bus",'allocation.busid=bus.busid');
	 $this->db->join("company","bus.companyid=company.companyid");
	 $this->db->where( array('allocation.id'=>$allocationid));
	 $result=$this->db->get();
	 $result=$result->result_array();
	return $result;

	 
 }
 

 //function to get the bus number of seats remaining

 public function getBusSeat($allocationid){
	 $result=$this->db->get_where('booking',array("allocationid"=>$allocationid));
	 $numberOfSeats;
	 $result=$result->result_array();
	 foreach($result as $r){
		 $numberOfSeats=$r['seatsremaining'];
	 }
	 return $numberOfSeats;
 }

//function to update seats 
public function updateseat($allocationid,$nseat,$type){
	//get the seats first
	$seats=$this->getBusSeat($allocationid);
	if($type==="1"){
		$seats=$seats-$nseat;
	}else{
		$seats=$seats+$nseat;
	}
	//update
	$this->db->set('seatsremaining',$seats);
	$this->db->where(array("allocationid"=>$allocationid));
	$this->db->update('booking');

}








/************************************************** */
/*******************Transaction section************ */
/**************************************************** */

//function to create the booking 
private function createTicket($allocationid,$customerid,$amount,$date){
	$data=array(
				"allocationid"=>$allocationid,
				"customerid"=>$customerid,
				'amount'=>$amount,
				'date'=>$date
	);

	$this->db->insert("transaction",$data);
}

// function to delete a ticket

private function deleteTicket($tickecode){
	$this->db->where('ticketcode',$tickecode);
	$this->db->delete('transaction');
}

 //function to check whether the bus exist then booking

 public function checkBusallocation($allocationid,$userid,$amount,$nseat,$date){
	$dateToday=date("Y/m/d") ;
	$result= $this->db->get_where('booking',array("allocationid"=>$allocationid,"date"=>$date));
	$result=$result->result_array();
	//get the bus details
		
		if(sizeof($result)>0){
				
				//update the user balance

				$user=$this->getCustomer($userid);
					$balance;
				foreach($user as $customer){
					$balance=$customer['wallet'];
				}
				//check the user balance
				if($balance>=$amount){
				//do subtraction on the balance
				echo $balance;
				echo"<br/>";
				$balance=$balance-$amount;
				echo $balance;
				$this->db->set('wallet',$balance);
				$this->db->where(array("customerid"=>$userid));
				$this->db->update('customer');

				$numberOfSeats;
				foreach($result as $row){
					$numberOfSeats=$row['seatsremaining'];

				}
				$numberOfSeats=$numberOfSeats-$nseat;
				//update the number of seats
				$this->db->set("seatsremaining",$numberOfSeats);
				
				$this->db->where(array("allocationid"=>$allocationid,"date"=>$dateToday));
				$this->db->update('booking');
				
				//create a ticket
				$this->createTicket($allocationid,$userid,$amount,$date);
			}else{
				//out that the balance is not sufficient
				echo "Check you balance";
			}




				}else{
			
			$numberOfSeats;
			$result=$this->getBus($allocationid);
			foreach($result as $row){
				$numberOfSeats=$row['seat'];
			}

			
			$data=array(
				'date'=>date("Y/m/d"),
				'allocationid'=>$allocationid,
				'seatsremaining'=>$numberOfSeats
			);

			$this->db->insert('booking',$data );
			//call the method again
			$this->checkBusallocation($allocationid,$userid,$amount,$nseat,$date);
			
		}


		// print_r($result);

}
	//function to cancel the bus booking
	public function cancelBook($tickecode,$allocationid,$userid,$amount,$nseat,$date){
		//check the  ticket experiry
		$ticketstatus=$this->ticketExipery($tickecode);
		if($ticketstatus==="1"){
			echo"Ticket can not be cancelled";
		}else{
			//update customer balance
			$this->updateBalance($userid,"0",$amount);

			//update the seats
			$this->updateseat($allocationid,$nseat,"1");
			echo"cancelled";

			//delete the ticket
			$this->deleteTicket($tickecode);

		}
		

		
	}

	//function to get the ticket per ticket code
	public function getTicket($tickecode){
		$result=$this->db->get_where('transaction',array('ticketcode'=>$tickecode));
		$result=$result->result_array();
		return $result;	
	}

	//function to check the bus expirery
	public function ticketExipery($tickecode){
		//get the ticket
		$ticket=$this->getTicket($tickecode);
		$dateToday=date("Y-m-d");
		$tickeDate;
		foreach($ticket as $date){
			$tickeDate=$date['date'];
		}
		echo $tickeDate;
		echo $dateToday;
		if($tickeDate===$dateToday){
			return "0";
		}else{
			return "1";
		}
		
	}


}
?>