<!--  -->
<div class="row">
    <!-- div for the login section -->
    <div class="col-md-4 themecolorleft">
     
    <?php echo validation_errors();?>
     <?php echo form_open('Welcome/loginUser');?>
    <div class="leftdiv">
    <div class="well">
        <h1 class="titletext">Login</h1>
           
        <div class="form-group ">
            
            <input type="email" class="form-control" name="email" placeholder="email">
        </div>
        <div class="form-group">
        
            <input type="password" class="form-control" placeholder="password" name="password">
        </div>
        <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
        </div>
        <button class="btn btn-success" type="submit">Login</button>
       <a class="btn btn-primary" href="<?=base_url('Welcome/registerpage')?>">Register</a>
</div>
        </form>
</div>

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