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
        $result=$this->db->get();
        $amount=0;
        $result=$result->result_array();
        foreach ($result as $row){
            $amount+=$row['amount'];
        }
        return $amount;
}

//get the cash of a particular day
public function dateAmount($date){
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


//function to get the total amount of current month

public function currentMonth(){
    //get today date
    $date=date('d');
    $amount=0;
    for($i=1;$i<=$date;$i++){
        $datepick=date('Y-m')."-".$i;
        $amount+=$this->dateAmount($datepick);
    }
   return $amount;

}
//function to get the amount of a given month
public function monthAmount($month){
    $amount=0;
    for($i=1;$i<=$date;$i++){
        $datepick=date('Y').$month."-".$i;
        $amount+=$this->dateAmount($datepick);
    }
   return $amount;
}




}
?>