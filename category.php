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
                
         $per_page=5;
               if(isset($_GET['page'])) 
               {
                   
                  $page=$_GET['page']; 
                   
               }
                else
                {
                    
                    $page="";
                }
                if($page=="" || $page==1)
                {
                    
                    $page_1=0;
                    
                }
                else
                {
                    
                    
                    $page_1=($page * $per_page) - $per_page;
                }        
                
                
                
                
                
            if(isset($_GET['category']))
            {
             $the_post_id=$_GET['category'];  
              
                    if($_SESSION['user_role'] && $_SESSION['user_role']=='admin' )
        {
        $query="select * from posts where post_category_id={$the_post_id} limit $page_1, $per_page";
        }
        else{
        $query="select * from posts where post_category_id={$the_post_id} and post_status='published' limit $page_1, $per_page";     
        }
                    
               // echo $query;
               // exit;
            $select_all_post_queries= mysqli_query($connection,$query);
                 $count=mysqli_num_rows($select_all_post_queries);
                $count1=ceil($count/5);
                if($count<1){
                    
                    echo "<h1 class='text-center'>No Posts available!!!</h1>";
                } else {
                    while($row=mysqli_fetch_assoc($select_all_post_queries))
                    {
                         $post_id=$row['post_id'];
                         $post_title=$row['post_title'];
                         $post_user=$row['post_user'];
                        $post_content=substr($row['post_content'],0,50);
                         $post_date=$row['post_date'];
                         $post_image=$row['post_image'];
                        
                    $query="select * from users  where user_id='$post_user'";
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
                    by <a href="index.php"><?php echo $post_user1;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
             <?php }} }
                    else
                    {
                        header("index.php");
                    }?>
            </div>
            
             
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
               
        <!-- /.row -->
        </div>
        
        <hr>
        <ul class="pager">
            
            <?php
            for($i=1;$i<=$count1;$i++){
                if($i==$page){
               echo "<li><a class='active_link' href='category.php?page={$i}&category=$the_post_id'>{$i}</a></li>"; 
                }
                else
                {
                  echo "<li><a href='category.php?page={$i}&category=$the_post_id'>{$i}</a></li>";  
                }
            }
            
            ?>
        </ul>


<?php include "includes/footer.php"; ?>
</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>