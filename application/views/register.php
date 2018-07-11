<!--  -->
<div class="row">
    <!-- div for the login section -->
    <div class="col-md-4" class="leftdiv">
       
        <?php echo validation_errors();?>
     <?php echo form_open('Welcome/registerUser');?>
     <div class="leftdiv">
       <div class="well">
       <h1 class="texttitle">Register</h1>
        <div class="form-group">
            
            <input type="email" class="form-control" name="email" placeholder="email">
        </div>
        <div class="form-group">
            
            <input type="text" class="form-control" name="name" placeholder="Group name">
        </div>
       
        <div class="form-group">
        
        <input type="password" class="form-control" placeholder="confirm password" name="password">
       </div>
        <div class="form-group">
        
        <input type="password" class="form-control" placeholder="confirm password" name="confirmpassword">
       </div>
       
        <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
        </div>
        <button class="btn btn-success" type="Register" class="btn btn-default">Submit</button>
</div></div>
       </form>

     </div>
     <div class="col-md-8 right">
         <div class="cent">
             <div class="inner">
             <img  src="<?php echo base_url('resources/rounded.jpeg');?>" width="200" height="200" class="  img-reponsive img-circle"/>
             <br/>
             <br/>
             <h1 class=" form-control text-to-center titletext"> echama</h1>
         </div>
         </div>
     </div>

</div>