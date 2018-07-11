<div class="row well">
    <!-- this is the top div -->
    <div class="col-md-4 text-to-center ">
    <h4>Current Group Members</h4>
    <h1  class="titletext"><?= $totalmembers?></h1>
    </div>
    <div class="col-md-4 text-to-center ">
    <h4>Current Total Amount</h4>
    <h1 class="titletext"><?= $totalcontribution?></h1>
    </div>
    
    <div class="col-md-4 text-to-center ">
    <h4>Current Total loan</h4>
    <h1  class="titletext"><?= $totalloan?></h1>
    </div>

</div>
<!-- div for dividing the page into two -->
<div class="row">
    <div class="col-md-5 well">
        <h1 class="titletext">Contribution</h1>
        <?php
       
        
         foreach($transaction as $row){
         echo'
         <div class="">
         <div class="row">
         <div class="col-md-2 ">'.$row["amount"].'</div>
         <div class="col-md-4 ">Korir Kipkoech</div>
         <div class="col-md-4 ">'.$row["date"].'</div>       
         
       
         </div>    
         </div>  
         
     
         ';
         }

     ?>
    </div>
<div class="col-md-1"></div>
<!-- section for loan-->    
    <div class="col-md-5 well">
    <h1 class="titletext">Loan Transactions</h1>
    <?php
   
         foreach($loanrequest as $row){
             $url=$row['loanid'].'/'.$row['amount'].'/'.$row['nationalid'].'/'.$row['duedate'];
             $accept=base_url('welcome/acceptloan/'.$url);
             $decline=base_url('welcome/declineloan/'.$row['loanid']);
         echo'
    <div class="">
        <div class="row">
      
        <div class="col-md-9 "> Name '.$row['name'].'</div>
        </div>

        <div class="row">
        <div class="col-md-4 "> Amount '.$row['amount'].'</div>
        <div class="col-md-4"> Due :'.$row['duedate'].'</div>
        <div class="col-md-2"><a href="'. $decline.'"><button class=" btn btn-danger">Decline</button></a></div>
        <div class="col-md-2"><a href="'.$accept.'"><button class=" btn btn-success">Accept</button></a></div>
        </div>
        </div>  
        ';
         }
         ?>
    </div>
</div>

