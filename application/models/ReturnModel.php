<?php
defined('BASEPATH')OR exit('No direct script access allowed');
class ReturnModel extends CI_Model{
    public function currentid(){

		$id=$this->session->userdata('id');
		
	
	
		return $id;
	}

    //function to return all the transactiom
    public function gettransaction(){
        $gproupid=$this->session->userdata('id');
        
        $this->db->from('contribution');
        $this->db->where('contribution.groupid',$gproupid);
        $this->db->join('members','members.nationalid=contribution.memberid');

        $result=$this->db->get();
        $result=$result->result_array();
        return $result;


    }
    public function getLoan(){
        $id=$this->session->userdata('id');
        $this->db->select('*');
        $this->db->from('loan');
        $this->db->where('loan.groupid',$id);
        $this->db->join('members','loan.memberid=members.nationalid','left');
        $result=$this->db->get();
        $result=$result->result_array();
        return $result;
    }


    //get loan requests
    public function getLoanRequest(){
        $this->db->select('*');
        $this->db->from('loanapplication');
        $this->db->join('members','loanapplication.memberid=members.nationalid','left');
        $result=$this->db->get();
        $result=$result->result_array();
        return $result;
    }

    //function to accept loan
    public function acceptloan($loanid ,$memberid,$amount,$dueday){

        $count=sizeof($this->inLoanList($memberid));
        $result=$this->inLoanList($memberid);
       
        if($count>0){
            //update the table amount
            $currentamount=0;
            foreach($result as $row){
               $currentamount= $row['amount'];
            }
            $currentamount+=$amount;
            $data = array(
                'duedate'=>$dueday,
                'amount' => $currentamount
                
        );
        
        $this->db->where('memberid', $memberid);
        $this->db->update('loan', $data);

        $this->decline($loanid);
        }else{
            $data=array(
                'memberid'=>$memberid,
                'amount'=>$amount,
                'duedate'=>$dueday,
                'groupid'=>'ehg'

            );
            $this->db->insert('loan',$data);
          
            //delete from application
            $this->decline($loanid);
        }

    }

    //function to repayloan
    public function repayloan($nationalid,$amount){
        $result=$this->inLoanList($nationalid);
        $count=sizeof($this->inLoanList($nationalid));
       
        if($count>0){
            //update the table amount
            $currentamount=0;
            foreach($result as $row){
               $currentamount= $row['amount'];
            }
            $currentamount-=$amount;
            $data = array(
                'amount' =>$currentamount);
                 $this->db->where('memberid', $nationalid);
                 $this->db->update('loan', $data);   
          
        }
                   
   
         
    }

    //function to check if the user is in the loan list
    public function inLoanList($userid){
        $this->db->select('*');
        $this->db->from('loan');
        $this->db->where('memberid',$userid);
        $result=$this->db->get();
        $result=$result->result_array();
       
        return $result;

   }



    //function to reject loan
    public function decline($loanid){
    $this->db->where('loanid',$loanid);
    $this->db->delete('loanapplication');
    }

    //function to list groupmembers
    public function  members(){
        $id=$this->session->userdata('id');
        $this->db->from('members');
        $this->db->where('groupid',$id);
       $result= $this->db->get();
       $result=$result->result_array();
       return $result;

    }
    //function delete member
    public function deleteMember($id){
        $this->db->where('nationalid',$id);
        $this->db->delete('members');
    }



    //members of a group
    public function countMembers(){
        $id=$this->session->userdata('id');
        $this->db->from('members');
        $this->db->where('groupid',$id);
       $result= $this->db->get();
       $result=$result->result_array();
       return sizeof($result);

    }
    //delete contribution
    public function deleteContribution($id){
        $this->db->where('transactionid',$id);
        $this->db->delete('contribution');
    }
    //group cash
    public function totalcontribution(){
        $id=$this->session->userdata('id');
        $this->db->from('contribution');
        $this->db->where('groupid',$id);
       $result= $this->db->get();
       $result=$result->result_array();
       $amount=0;
       foreach($result as $row){
           $amount+=$row['amount'];

       }
       return $amount;

    }

    //group loan
    public function totalloan(){
        $id=$this->session->userdata('id');
        $this->db->from('loan');
        $this->db->where('groupid',$id);
       $result= $this->db->get();
       $result=$result->result_array();
       $amount=0;
       foreach($result as $row){
           $amount+=$row['amount'];

       }
       return $amount;

    }



}?>