<?php
class Analytic extends CI_Controller{




//function to add the contributtion
public function addcontribution(){
    

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
















































    public $mondayEarning=0;
    public $tuesdayEarning=0;
    public $wednesdayEarning=0;
    public $thurdayEarning=0;
    public $fridayEarnning=0;
    public  $saturdayEarning=0;
    public $sundayEarning=0;
    public function index(){
       $number=$this->AnalyticModel->noBuses("2");
        $dayOfWeek=date("w");
        $today=date("Y-m-d");
        echo $today;

        //get the company id
        $companyid=2;


























































    // for one company 
       $dateCash=$this->AnalyticModel->dateAmount($today,$companyid);
       echo $dateCash;
       $monthCash=$this->AnalyticModel->currentMonth($companyid);
        
    //other commpanies
        $otherdateamount=$this->AnalyticModel->otherDateAmount($today);
        $otherdateamount-=$dateCash;
        $othermonthCash=$this->AnalyticModel->otherMonthAmount();
        $othermonthCash-=$monthCash;
    //life time for the company
        $lifeTimeEaring=$this->AnalyticModel->getLifeEarning($companyid);
        //run the day comparison function
        $this->dayComparison($companyid);

       
    
        // load the views from here
        $dataset= array(
            'yourearning'=>$dateCash,
            'monthearning'=>$monthCash,
            'lifeEarning'=>$lifeTimeEaring,
            'othertoday'=>$otherdateamount,
            'othermonthearning'=>$othermonthCash,

            'monday'=>$this->mondayEarning,
            'tuesday'=>$this->tuesdayEarning,
            'wednesday'=>$this->wednesdayEarning,
            'thurday'=>$this->thurdayEarning,
            'friday'=>$this->fridayEarnning,
            'saturday'=>$this->saturdayEarning,
            'sunday'=>$this->sundayEarning

        );
        // print_r($dataset);
        $this->load->view('header');
        $this->load->view('body',$dataset);

    }

    //function to create a formatted date
    public function formatDate($i){
        
        $dayOfWeek;
        $dayOfWeek=date("w");
        $diff=$dayOfWeek-$i;
        $todayDate=date('d');
        $todayDate-=$diff;
        $date=date('Y-m')."-".$todayDate;
       
        return $date;
    }

    //working on the day comparison;
    public function dayComparison($companyid){
        $dayOfWeek=date("w");
        for($i=1;$i<=$dayOfWeek;$i++){
            switch($i){
                case 1:
                $this->mondayEarning=$this->AnalyticModel->dateAmount($this->formatDate($i),$companyid);
               break;
                
                case 2:
                $this->tuesdayEarning=$this->AnalyticModel->dateAmount($this->formatDate($i),$companyid);
                
                break;
                case 3:
                $this->wednesdayEarning=$this->AnalyticModel->dateAmount($this->formatDate($i),$companyid);
                break;
                case 4:
                $this->thurdayEarning=$this->AnalyticModel->dateAmount($this->formatDate($i),$companyid);
                break;
                case 5:
                $this->fridayEarnning=$this->AnalyticModel->dateAmount($this->formatDate($i),$companyid);
               
                break;
                case 6:
                $this->saturdayEarning=$this->AnalyticModel->dateAmount($this->formatDate($i),$companyid);
                break;
                case 7:
                $this->sundayEarning=$this->AnalyticModel->dateAmount($this->formatDate($i),$companyid);
                break;
                

            }

         }
    }

    

}
?>