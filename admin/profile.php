<?php include "includes/admin_header.php"; ?>
    <?php

if(isset($_SESSION['username']))
{
   $username=$_SESSION['username'];
    $query="SELECT * FROM USERS WHERE USERNAME='$username'";
    $select_user_profile=mysqli_query($connection,$query);
    while($row=mysqli_fetch_array($select_user_profile))
    {
        
                                $user_id=$row['user_id'];
                                $username=$row['username'];
                                $user_password=$row['user_password'];
                                $user_firstname=$row['user_firstname'];
                                $user_lastname=$row['user_lastname'];
                                //$post_content=substr($row['post_content'],0,50);
                                $user_email=$row['user_email'];
                               // $user_image=$row['user_image'];
                                $user_role=$row['user_role']; 
        
        
    }
}
?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include "includes/admin_navigation.php"; ?>


    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                   

   
   
   <form method="post" action="" enctype="multipart/form-data">
    
        <div class="form-group">
         <label for="post_author">FirstName</label>
         <input type="text"  value="<?php echo $user_firstname;?>" class="form-control" name="user_firstname">
        </div>
        
        <div class="form-group">
         <label for="post_status">LastName</label>
         <input type="text"  value="<?php echo $user_lastname;?>" class="form-control" name="user_lastname">
        </div>
        
         
           <div class="form-group">
         <label for="title">UserName</label>
         <input type="text" value="<?php echo $username;?>"   class="form-control" name="username">
        </div>
    
              
    
    
      
    
        <div class="form-group">
         <label for="email">Email</label>
         <input type="text"    value="<?php echo $user_email;?>" class="form-control" name="user_email">
        </div>
        <div class="form-group">
         <label for="post_tags">Password</label>
         <input type="password"  autocomplete="off" class="form-control" name="user_password">
        </div>
    
       
        <div class="form-group">
            
            <input class="btn btn-primary" type="submit" name="edit_user" value="Update_Profile">
        </div>
    
</form>
     
     <?php
if(isset($_POST['edit_user']))
{

$user_firstname=$_POST['user_firstname'];
$user_lastname=$_POST['user_lastname'];
//$user_role=$_POST['user_role'];
    $user_name=$_POST['username'];
$user_email=$_POST['user_email'];
//$post_image=$_FILES['image']['name'];
//$post_image_temp=$_FILES['image']['tmp_name'];
//$user_password=$_POST['user_password'];
$user_password=$_POST['user_password'];
    
   if(!empty($user_password)){
       
       $query_password="select user_password from users where username='{$username}'";
       //echo $query_password;
    //exit;
       $select_password=mysqli_query($connection,$query_password);
        confirm_query($select_password);
       $row=mysqli_fetch_array($select_password);
       
       $db_user_password=$row['user_password'];
   
   if($db_user_password!=$user_password) {
    
    
 $user_password=password_hash( $user_password, PASSWORD_BCRYPT,array('cost'=>12));
       
      
       $query="update users set user_password='{$user_password}' where username='{$username}'";
       $update_query=mysqli_query($connection,$query);
    confirm_query($update_query);
   }
   }
   
    $query="update users set ";
    $query.="username='{$user_name}', ";
    $query.="user_firstname='{$user_firstname}', ";
   
    $query.="user_lastname='{$user_lastname}', ";
    
    $query.="user_email='{$user_email}'";
    
   
    $query.="where username='{$username}'";
    $update_user=mysqli_query($connection,$query);
//echo $query;
   //exit;
    confirm_query($update_user);
    echo "Profile Updated Successfully:";
   }
   

    
    ?>
      
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include "includes/admin_footer.php";?>