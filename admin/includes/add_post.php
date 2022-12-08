<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>

<?php
if(isset($_POST['create_post']))
{
        $post_title=escape($_POST['title']);
        $post_user=escape($_POST['post_user']);
        $post_category_id=escape($_POST['post_category']);
        $post_status=escape($_POST['post_status']);
        $post_image=$_FILES['image']['name'];
        $post_image_temp=$_FILES['image']['tmp_name'];
        $post_tags=escape($_POST['post_tags']);
        $post_content=escape($_POST['post_content']);
        $post_date=date('d-m-y');
        $post_comment_count=0;
        $post_views_count=0;
        move_uploaded_file($post_image_temp,"../images/$post_image");
        $query="insert into posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags
        ,post_status,post_comment_count,post_views_count)";
        $query.="values('{$post_category_id}','{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}','{$post_comment_count}','{$post_views_count}')";

        $create_query=mysqli_query($connection,$query);
        confirm_query($create_query);

        $p_id=mysqli_insert_id($connection);

        echo "<p class='bg-success'>Posts Created:"." "."<a href='../post.php?p_id={$p_id}'>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";
}
?>
   

   
   
   
   <form method="post" action="" enctype="multipart/form-data">
    
        <div class="form-group">
         <label for="title">Post Title</label>
         <input type="text" class="form-control" name="title">
        </div>
    
              <div class="form-group">
              <label for="category">Category</label>
         <select id="" name="post_category">
             
            <?php
            $query="select * from category";
            $select_category=mysqli_query($connection,$query);
            confirm_query($select_category) ; 
            while($row=mysqli_fetch_assoc($select_category))
            {
                $cat_id=$row['cat_id'];
                $cat_title=$row['cat_title'];
            echo "<option value='$cat_id'> {$cat_title} </option>";
            }
            ?>   
             
         </select>
        </div>
        <div class="form-group">
              <label for="username">Username</label>
         <select id="" name="post_user">
             
            <?php
            $query="select * from users";
            $select_category=mysqli_query($connection,$query);
            confirm_query($select_category) ; 
            while($row=mysqli_fetch_assoc($select_category))
            {
                $cat_id=$row['user_id'];
                $cat_title=$row['username'];
            echo "<option value='$cat_id'> {$cat_title} </option>";
            }
            ?>   
             
         </select>
        </div>
    
    
      
        
        <div class="form-group">
         <label for="post_status">Post Status</label>
         <select id="" name="post_status">
           
            <option value="draft">Select Options</option>
             
             <option value="published">Published</option>
            <option value="draft">Draft</option>
             
         </select>
        </div>
    
        <div class="form-group">
         <label for="image">Image</label>
         <input type="file"  name="image">
        </div>
        <div class="form-group">
         <label for="post_tags">Post Tags</label>
         <input type="text" class="form-control" name="post_tags">
        </div>
    
       <div class="form-group">
         <label for="summernote">Post Content</label>
         <textarea type="text" class="form-control" name="post_content" id="summernote" rows="10" cols="30"></textarea>

        </div>
        <div class="form-group">
            
            <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
        </div>
    
</form>