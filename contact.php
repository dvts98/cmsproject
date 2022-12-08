<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

    
    
    
    <?php
if(isset($_POST['submit']))
{
    
   // echo "hi";
    //exit;
$to="dvts98@gmail.com";
$subject= wordwrap(escape($_POST['subject']),70);
$body=escape($_POST['body']);
    $header=escape($_POST['email']);
    //echo $subject;
   // exit;
    mail($to,$subject,$body,$header);
    
 if(!empty($to) && !empty($subject) && !empty($body))  
   {
   $message= "Your Registration has been submitted:";
     }
    else
    {
        
       $message= "Feilds cannot be Empty";
    }
        
}

else
{
    $message="";
}

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-center">Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                       <h6 class="text-center">
                           <?php echo $message;?>
                       </h6>
                       
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
                        </div>
                <textarea name="body" class="form-control" id="body" cols="50" rows="10"></textarea>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
