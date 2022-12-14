<?php include "includes/db.php"; ?>
   <body>
    <?php include "includes/header.php"; ?>

    <!-- Navigation -->
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
                $the_post_author=$_GET['author'];
               
           }
            $query="select * from posts where post_user='{$the_post_author}'";
            $select_all_post_queries= mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_all_post_queries))
                    {
                         $post_id=$row['post_id'];
                         $post_title=$row['post_title'];
                         $post_author=$row['post_author'];
                         $post_content=$row['post_content'];
                         $post_date=$row['post_date'];
                         $post_image=$row['post_image'];
                         $query="select * from users  where user_id='$the_post_author'";
                                $select_username=mysqli_query($connection,$query);
                                while($row1=mysqli_fetch_assoc($select_username))
                                     $post_user1=$row1['username'];

              
            ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                   All post by <?php echo $post_user1;?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                 
                
                <hr>
           
          
            
             <!-- Blog Comments -->

                <!-- Comments Form -->
               

                <hr>

                <!-- Posted Comments -->
<?php
                $query ="select * from comments where comment_post_id={$post_id} ";
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
                
              <?php }} ?>
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