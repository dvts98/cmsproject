 <div class="col-md-4">
                
             

                <!-- Blog Search Well -->
                <div class="well">
                   <form action="search.php" method="post">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input name="search" type="text" id="search" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!--form serach -->
                    <!-- /.input-group -->
                </div>
                
                
                 <!-- loginform -->
                <div class="well">
                  
                  
                  <?php if(isset($_SESSION['user_role'])): ?>
                  <h4>
                      Logged in as <?php echo $_SESSION['user_role']; ?>
                  </h4>
                  <a href="includes/logout.php" class='btn btn-primary'>Logout</a>
                  <?php else: ?>
                   <form action="includes/login.php" method="post">
                    <h4>Login</h4>
                    <div class="form-group">
                        <input name="username" type="text" id="username" class="form-control" placeholder="Enter your UserName">
                        
                    </div>
                    <div class="input-group">
                        <input name="password" type="password" id="password" class="form-control" placeholder="Enter your Password">
                       <span class="input-group-btn">
                           <button class="btn btn-primary" name="login" type="submit">Submit
                             
                           </button>
                       </span> 
                    </div>
                    </form>
                  <?php endif; ?>
                  <!--form serach -->
                    <!-- /.input-group -->
                </div>
 
     
     
     
    
                <!-- Blog Categories Well -->
                <div class="well">
                   
                   <?php
                    
                 $query="select * from category";
                 $select_all_cate_queries=mysqli_query($connection,$query);
                    
                    ?>
                   
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                           
                            <ul class="list-unstyled">
                               <?php
                            while($row=mysqli_fetch_assoc($select_all_cate_queries))
                    {
                    $cat_title=$row['cat_title'];
                    $cat_id=$row['cat_id'];
                                
                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                            ?>
                                
                            </ul>
                        </div>
                        
                        
                        <!-- /.col-lg-6 -->
                        
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widjet.php"; ?>

            </div>