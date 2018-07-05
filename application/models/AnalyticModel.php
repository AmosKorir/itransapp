<?php
defined('BASEPATH')OR exit('No direct script access allowed');
class AnalyticModel extends CI_Model{

    //function to get the number of buses => company
public function noBuses($companyid){
    $count;
    $result=$this->db->get_where('bus',array('companyid='.$companyid));
    $result=$result->result_array();
    return sizeof($result);    
}

//function to to get the amount of cash of a company
/***************************************************/
/****************this is cash calculation method */

public function companyCash($companyid){
    $this->db->select("transaction.amount");
        $this->db->from("bus");
        $this->db->join('allocation','allocation.busid=bus.busid');
        $this->db->join('transaction','transaction.allocationid=allocation.id');
        $this->db->where(array('bus.companyid'=>$companyid));
        $result=$this->db->get();
        $amount=0;
        $result=$result->result_array();
        foreach ($result as $row){
            $amount+=$row['amount'];
        }
        return $amount;
}

//get the cash of a particular day of one company
public function dateAmount($date,$companyid){
    $this->db->select("transaction.amount");
    $this->db->from("transaction");
    $this->db->join('allocation','allocation.busid=transaction.allocationid');
    $this->db->join('bus','bus.busid=allocation.busid');   
    $this->db->where(array('transaction.date'=>$date,'bus.companyid'=>$companyid));
    $result=$this->db->get();
    $amount=0;   
    $result=$result->result_array();  
  
    foreach ($result as $row){
      
        $amount+=$row['amount'];
    }
    return $amount/2;
}

//get the cash of other companies at other days
public function otherDateAmount($date){
    $this->db->select("transaction.amount");
    $this->db->from("bus");
    $this->db->join('allocation','allocation.busid=bus.busid');
    $this->db->join('transaction','transaction.allocationid=allocation.id');
    $this->db->where(array('transaction.date'=>$date));
    $result=$this->db->get();
    $amount=0;
    $result=$result->result_array();
    foreach ($result as $row){
        $amount+=$row['amount'];
    }
    return $amount;

} 


//function to get the total amount of current month for all companies


public function currentMonth($companyid){
    //get today date
    $date=date('d');
    $amount=0;
    for($i=1;$i<=$date;$i++){
        $datepick=date('Y-m')."-".$i;
        $amount+=$this->dateAmount($datepick,$companyid);
    }
   return $amount;

}
//function to get the amount ...lifetime-company
public function getLifeEarning($companyid){
    $this->db->select("transaction.amount");
    $this->db->from("bus");
    $this->db->join('allocation','allocation.busid=bus.busid');
    $this->db->join('transaction','transaction.allocationid=allocation.id');
    $result=$this->db->get();
    $amount=0;
    $result=$result->result_array();
    foreach ($result as $row){
        $amount+=$row['amount'];
    }
    return $amount;

}
//function to get the amount of a given month
public function monthAmount($month,$companyid){
    $amount=0;
    for($i=1;$i<=$date;$i++){
        $datepick=date('Y').$month."-".$i;
        $amount+=$this->dateAmount($datepick,$companyid);
    }
   return $amount;
}

//function to get the month amount for all companies

private function getAllMonth($date){
    $this->db->select("transaction.amount");
    $this->db->from("bus");
    $this->db->join('allocation','allocation.busid=bus.busid');
    $this->db->join('transaction','transaction.allocationid=allocation.id');
    $this->db->where(array('transaction.date'=>$date));
    $result=$this->db->get();
    $amount=0;
    $result=$result->result_array();
    foreach ($result as $row){
        $amount+=$row['amount'];
      
    }
    
    return $amount;

}

public function otherMonthAmount(){
     //get today date
     $date=date('d');
     $amount=0;
     for($i=1;$i<=$date;$i++){
         $datepick=date('Y-m')."-".$i;
         $amount+=$this->getAllMonth($datepick);
     }
    
    return $amount;
 
}





}
?>