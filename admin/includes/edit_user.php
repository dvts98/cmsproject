<?php
if(isset($_POST['edit_user']))
{
$the_user_id=$_GET['edit_user'];
$user_firstname=escape($_POST['user_firstname']);
$user_lastname=escape($_POST['user_lastname']);
$user_role=escape($_POST['user_role']);
$username=escape($_POST['username']);
$user_email=escape($_POST['user_email']);
//$post_image=$_FILES['image']['name'];
//$post_image_temp=$_FILES['image']['tmp_name'];
$user_password=escape($_POST['user_password']);
    
   if(!empty($user_password)){
       
       $query_password="select user_password from users where user_id='$the_user_id'";
       $select_password=mysqli_query($connection,$query_password);
        confirm_query($select_password);
       $row=mysqli_fetch_array($select_password);
       
       $db_user_password=$row['user_password'];
  
    
   if($db_user_password!=$user_password) {
    
    
 $user_password=password_hash( $user_password, PASSWORD_BCRYPT,array('cost'=>12));
       $query="update users set user_password='{$user_password}' where user_id={$the_user_id}";
       $update_query=mysqli_query($connection,$query);
    confirm_query($update_query);
   }
}
    
    $query="update users set ";
    $query.="username='{$username}', ";
    $query.="user_firstname='{$user_firstname}', ";
   
    $query.="user_lastname='{$user_lastname}', ";
    $query.="user_role='{$user_role}', ";
    $query.="user_email='{$user_email}' ";
   
   
    $query.="where user_id={$the_user_id} ";
    $update_user=mysqli_query($connection,$query);
//echo $query;
 //  exit;
    confirm_query($update_user);
     echo "User Updated Successfully:";
}

    
    ?>

<?php
if(isset($_GET['edit_user']))
{
$the_user_id=$_GET['edit_user'];
//echo 'hi';



    //echo "h";
    //exit;
  $query="select * from users where user_id=$the_user_id";
                 $select_users=mysqli_query($connection,$query);
                    
                while($row=mysqli_fetch_assoc($select_users))
                    {
                                //$user_id=$row['user_id'];
                                $username=$row['username'];
                                $user_password=$row['user_password'];
                                $user_firstname=$row['user_firstname'];
                                $user_lastname=$row['user_lastname'];
                                //$post_content=substr($row['post_content'],0,50);
                                $user_email=$row['user_email'];
                                //$user_image=$row['user_image'];
                                $user_role=$row['user_role'];
                                
//$post_date=date('d-m-y');
   

//move_uploaded_file($post_image_temp,"../images/$post_image");
   // $query="insert into users(`username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`,`user_role`)";
   // $query.="values('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}')";
    
   // $create_query=mysqli_query($connection,$query);
   // confirm_query($create_query);
//
   

   ?>
   
   
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
              <label for="post_status">Role</label>
         <select id="" name="user_role">
           
            <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
             <?php   
             if($user_role=='admin')
             { ?>
               <option value="subscriber">Subscriber</option>
                
            <?php     
             }
             
             
            if($user_role=='subscriber')
             {
                ?>
                
             <option value="admin">Admin</option> 
            <?php
            }
                    ?>
         </select>
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
            
            <input class="btn btn-primary" type="submit" name="edit_user" value="Edit_User">
        </div>
    
</form>
    <?php      }}
?>   