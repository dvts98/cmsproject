

<?php
if(isset($_POST['add_user']))
{
    //echo "h";
    //exit;
        $user_firstname=escape($_POST['user_firstname']);
        $user_lastname=escape($_POST['user_lastname']);
        $user_role=escape($_POST['user_role']);
            $username=escape($_POST['username']);
        $user_email=escape($_POST['user_email']);
        //$post_image=$_FILES['image']['name'];
        //$post_image_temp=$_FILES['image']['tmp_name'];
        $user_password=escape($_POST['user_password']);

        //$post_date=date('d-m-y');

        // $query="select randSalt from users";
       // $select_ransalt=mysqli_query($connection,$query);
       // if(!$select_ransalt)
      //  //{
       //     die('Query Failed'.mysqli_error($connection));


        //}

      //  $row=mysqli_fetch_array($select_ransalt);
       // $salt=$row['randSalt'];

        //$user_password=crypt($user_password,$salt);

    $user_password=password_hash( $user_password, PASSWORD_BCRYPT,array('cost'=>12));

//move_uploaded_file($post_image_temp,"../images/$post_image");
    $query="insert into users(`username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`,`user_role`)";
    $query.="values('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}')";
    
    $create_query=mysqli_query($connection,$query);
    confirm_query($create_query);
    echo "User Created Successfully:"." "."<a href='users.php'>View Users</a>";
}
?>
   

   
   
   
   <form method="post" action="" enctype="multipart/form-data">
    
        <div class="form-group">
         <label for="post_author">FirstName</label>
         <input type="text" class="form-control" name="user_firstname">
        </div>
        
        <div class="form-group">
         <label for="post_status">LastName</label>
         <input type="text" class="form-control" name="user_lastname">
        </div>
        
         
           <div class="form-group">
         <label for="title">UserName</label>
         <input type="text" class="form-control" name="username">
        </div>
    
              <div class="form-group">
              <label for="post_status">Role</label>
         <select id="" name="user_role">
           
            <option value="subscriber">Select Options</option>
             
             <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
             
         </select>
        </div>
    
    
      
    
        <div class="form-group">
         <label for="email">Email</label>
         <input type="text"   class="form-control" name="user_email">
        </div>
        <div class="form-group">
         <label for="post_tags">Password</label>
         <input type="password" class="form-control" name="user_password">
        </div>
    
       
        <div class="form-group">
            
            <input class="btn btn-primary" type="submit" name="add_user" value="Add_User">
        </div>
    
</form>