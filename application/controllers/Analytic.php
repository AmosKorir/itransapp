<?php
class Analytic extends CI_Controller{
    public function index(){
       $number=$this->AnalyticModel->noBuses("1");
       print_r($number);

       $transaction=$this->AnalyticModel->companyCash("1");
       print_r($transaction);
       echo"</br>";
       $dateCash=$this->AnalyticModel->dateAmount("2018-06-27");
       echo $dateCash;
       $date=date('d');
       echo"</br>";
       $monthAmount=$this->AnalyticModel->currentMonth();
       echo "current month ";
       echo  $monthAmount;
    }
}
?>