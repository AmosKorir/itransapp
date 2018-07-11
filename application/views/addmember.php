<div class="row">
    <div class="col-md-5 padd well">
    <h1 class="titletext">Add a new member</h1>
        <!-- adding section-->
        <?php echo validation_errors();?>
        <?php echo form_open('Welcome/addmember');?>
        
        <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="name">
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="id" placeholder="ID">
        </div>
        <div class="form-group">
        
        <input type="phone" class="form-control" name="phone" placeholder="Phone">

        </div>
        <button class="btn btn-success" type="submit" class="btn btn-default">Add</button>
        </form>
        
    </div>
    <!-- right section of the page-->
    <div class="col-md-1"></div>
    <div class="col-md-6 well">
    <h1 class="titletext">Group Members</h1>
   <?php 
   $url=base_url('Welcome/deletemember/');
   foreach($members as $row){
   echo'
    <div class="welll">
        <div class="row">
        <div class="col-md-2 ">'.$row['nationalid'].'</div>
        <div class="col-md-4 ">'.$row['name'].'</div>
        <div class="col-md-2 ">'.$row['phone'].'</div>
        <div class="col-md-1"><a href="'.$url.$row['nationalid'].'"<button class=" btn btn-danger">Delete</button></a></div>
        </div>    
        </div>
        ';}?>  
        
    </div>
    </div>

   
</div>
