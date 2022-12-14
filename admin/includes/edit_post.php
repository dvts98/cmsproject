

 <?php
if(isset($_GET['p_id']))
{
                          $p_id=escape($_GET['p_id']);
    
    

                          
                          $query="select * from posts where post_id='$p_id'";
                 $select_posts=mysqli_query($connection,$query);
                    
                while($row=mysqli_fetch_assoc($select_posts))
                    {
                                $post_id=$row['post_id'];
                                $post_title=$row['post_title'];
                                $post_user=$row['post_user'];
                                $post_date=$row['post_date'];
                                $post_image=$row['post_image'];
                                $post_content=$row['post_content'];
                                $post_tags=$row['post_tags'];
                                $post_status=$row['post_status'];
                                $post_category_id=$row['post_category_id'];
                    $query="select * from category where cat_id='$post_category_id'";
                 $select_category=mysqli_query($connection,$query);
                  confirm_query($select_category) ; 
                while($row1=mysqli_fetch_assoc($select_category))
                     $post_category_title=$row1['cat_title'];
                    
                    $query="select * from users where user_id='$post_user'"; 
        $select_user=mysqli_query($connection,$query);
        while($row2=mysqli_fetch_array($select_user))
       
            $post_user1=$row2['username'];
                    //echo $post_content;;
                }
}
if(isset($_POST['update_post']))
{
   $post_title=escape($_POST['title']);
$post_user=escape($_POST['post_user']);
$post_category=escape($_POST['post_category']);
$post_status=escape($_POST['post_status']);
$post_image=$_FILES['image']['name'];
$post_image_temp=$_FILES['image']['tmp_name'];
$post_tags=escape($_POST['post_tags']);
$post_content=escape($_POST['post_content']);
$post_date=date('d-m-y');
$post_comment_count='0';
move_uploaded_file($post_image_temp,"../images/$post_image"); 
    
    if(empty($post_image))
    {
        
      $query="select * from posts where post_id='$p_id'"; 
        $select_image=mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($select_image))
        {
            $post_image=$row['post_image'];
        }
        
    }
    
    $query="update posts set ";
    $query.="post_title='{$post_title}', ";
    $query.="post_category_id='{$post_category}', ";
    $query.="post_date=now(), ";
    $query.="post_user='{$post_user}', ";
    $query.="post_status='{$post_status}', ";
    $query.="post_tags='{$post_tags}', ";
    $query.="post_content='{$post_content}', ";
    $query.="post_image='{$post_image}' ";
    $query.="where post_id={$p_id} ";
    $update_post=mysqli_query($connection,$query);
   // echo $query;
   // exit;
    confirm_query($update_post);
    echo "<p class='bg-success'>Posts Updated:"." "."<a href='../post.php?p_id={$p_id}'>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";

}
?>
   

   
   
   
   <form method="post" action="" enctype="multipart/form-data">
    
        <div class="form-group">
         <label for="title">Post Title</label>
         <input type="text" class="form-control" name="title" value="<?php echo $post_title?>">
        </div>
    
       <div class="form-group">
        <label for="category">Category</label>
         <select id="" name="post_category">
             
          <?php
     echo "<option value='$post_category_id'> {$post_category_title} </option>";
                 $query="select * from category";
                 $select_category=mysqli_query($connection,$query);
                  confirm_query($select_category) ; 
                while($row=mysqli_fetch_assoc($select_category))
                    {
                                $cat_id=$row['cat_id'];
                                $cat_title=$row['cat_title'];
                    if($cat_id!=$post_category_id)
                    
                    echo "<option value='$cat_id'> {$cat_title} </option>";
                }
             ?>   
             
         </select>
        </div>
        <div class="form-group">
              <label for="username">Username</label>
         <select id="" name="post_user">
             
            <?php
              echo "<option value='$post_user'> {$post_user1} </option>";       
               
            $query="select * from users";
            $select_category=mysqli_query($connection,$query);
            confirm_query($select_category) ; 
            while($row=mysqli_fetch_assoc($select_category))
            {
                $cat_id=$row['user_id'];
                $cat_title=$row['username'];
             
                if($post_user1 != $cat_title)
                {
                     echo "<option value='$cat_id'> {$cat_title} </option>";       
                } 
            }
            ?>   
             
         </select>
        </div>
    
      
        
        <div class="form-group">
         <label for="post_status">Post Status</label>
         <select id="" name="post_status">
           
            <option value="<?php echo $post_status; ?>"><?php echo $post_status;?></option>
             <?php   
             if($post_status=='published')
             { ?>
               <option value="draft">Draft</option>
                
            <?php     
             }
             
             
            if($post_status=='draft')
             {
                ?>
                
             <option value="published">Published</option> 
            <?php
            }
                    ?>
         </select>
         
        </div>
    
        <div class="form-group">
        
        <img width='100' src=../images/<?php echo $post_image; ?> alt="">
        <input type="file" name="image">
        </div>
        <div class="form-group">
         <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags;?>">
        </div>
    
       <div class="form-group">
         <label for="summernote">Post Content</label>
         <textarea type="text" class="form-control" name="post_content" id="summernote" rows="10" cols="30"><?php echo  $post_content;?></textarea>
        </div>
        <div class="form-group">
            
            <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
        </div>
    
</form>