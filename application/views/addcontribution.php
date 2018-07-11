<div class="row">
    <div class="col-md-5 well padd">
    <h1 class="titletext ">Make contribution</h1>
        <!-- adding section-->
        <?php echo validation_errors();?>
     <?php echo form_open('Welcome/addcontribution');?>
        <div class="form-group">
        
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="id" placeholder="ID">
        </div>
        <div class="form-group">
        
        <input type="number" class="form-control" name="amount" placeholder="amount">

        </div>
        <button class="btn btn-success" type="submit" class="btn btn-default">Submit</button>
        </form>
        
    </div>
    <div class="col-md-1 "></div>
    <!-- right section of the page-->
    <div class="col-md-6 well">
    <h1 class="titletext">Contribution Transactions</h1>
    <?php
        $deleteurl=base_url('Welcome/deletecontribution/');
         foreach($transaction as $row){
         echo'
         <div class="welll">
         <div class="row">
         <div class="col-md-2 ">'.$row["amount"].'</div>
         <div class="col-md-4 ">'.$row['name'].'</div>
         <div class="col-md-2 ">'.$row["date"].'</div>  
         <div class="col-md-2 ">'.$row["nationalid"].'</div>       
         
         <div class="col-md-1"><a href="'.$deleteurl.$row['transactionid'].'"<button class=" btn btn-danger">Delete</button></a></div>
         </div>    
         </div>  
         
     
         ';
         }

     ?>
     </div>
   
    </div>

   
</div>
