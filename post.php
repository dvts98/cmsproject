    <?php include "includes/db.php"; ?>
    <body>
    <?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            

            <!-- Blog Entries Column -->
            <div class="col-md-8">
        <?php
        if(isset($_GET['p_id'])) 
        {

        $the_post_id=$_GET['p_id'];
        $query="update posts set post_views_count=post_views_count+1 where post_id={$the_post_id}";
        $send_query=mysqli_query($connection,$query);
        if(!$send_query)
        {

        die("query failed");
        }

        if($_SESSION['user_role'] && $_SESSION['user_role']=='admin' )
        {
        $query="select * from posts where post_id={$the_post_id}";
        }
        else{
        $query="select * from posts where post_id={$the_post_id} where post_status='published'";      
        }
                
        $select_all_post_queries= mysqli_query($connection,$query);
                 $count=mysqli_num_rows($select_all_post_queries);
                if($count<1){
                    
                    echo "<h1 class='text-center'>No Posts available!!!</h1>";
                } else {
        while($row=mysqli_fetch_assoc($select_all_post_queries))
        {
        $post_title=$row['post_title'];
        $post_author=$row['post_author'];
        $post_content=$row['post_content'];
        $post_date=$row['post_date'];
        $post_image=$row['post_image'];
            $post_user=$row['post_user'];
                                $query="select * from users  where user_id='$post_user'";
                                $select_username=mysqli_query($connection,$query);
                                while($row1=mysqli_fetch_assoc($select_username))
                                     $post_user1=$row1['username'];

        ?>
                <h1 class="page-header">
                    Posts
                   
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_user1;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                 
                
                <hr>
            <?php } 
           ?>
            <?php
                

            if(isset($_POST['create_comment']))
            {
            // echo "H";
            //exit;
            $the_post_id=$_GET['p_id'];
            $comment_author=$_POST['comment_author'];
            $comment_email=$_POST['comment_email'];
            $comment_content=$_POST['comment_content']; 

            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) )  
            {
            $query="INSERT INTO `comments` (`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`)" ;

            $query .="VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved',now())";
            $create_comment_query=mysqli_query($connection,$query);
            if(!$create_comment_query)
            {
             die('QUERY FAILED'.mysqli.error($connection)) ;  

            }
            // $query ="update posts set post_comment_count=post_comment_count+1 ";
           // $query .="where post_id={$the_post_id}";
            //echo $query;
            //exit;
           // $update_query=mysqli_query($connection,$query);
            }
            else{

               echo "<script>alert('Feilds Cannot Be Empty')
                    </script>";
            }

            redirect("post.php?p_id=$the_post_id");


            }
    ?>

             <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                       
                       <div class="form-group">
         <label for="Author">Author Name</label>
         <input type="text" class="form-control" name="comment_author">
        </div>
                       <div class="form-group">
         <label for="Email">Email ID</label>
         <input type="email" class="form-control" name="comment_email">
        </div>
                        <div class="form-group">
                           <label for="Comment">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" value="create_comment" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                $query ="select * from comments where comment_post_id={$the_post_id} ";
                $query .="and comment_status='Approved' ";
                $query .="order by comment_id desc";
                //echo $query;
                //exit;
                $select_comment_query=mysqli_query($connection,$query);
                if(!$select_comment_query)
                {

                    die('OUERY FAILED'.mysqli_error($connection));
                }


                 while($row=mysqli_fetch_assoc($select_comment_query))
                    {

                                $comment_author=$row['comment_author'];
                                $comment_content=$row['comment_content'];
                                $comment_date=$row['comment_date'];


                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                   
                </div>

                <!-- Comment -->
                
              <?php } }}else{
            
            header("Location:index.php");
            }?>
            </div>
            
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
               
        <!-- /.row -->
        </div>
        
        <hr>

<?php include "includes/footer.php"; ?>
</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>