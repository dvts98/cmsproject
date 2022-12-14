<!-- edit category form -->
                       
                            <form action="" method="post">
                             <div class="form-group">
                               <?php //edit query display
                                      
                      if(isset($_GET['update']))
                      {
                          //echo "hi";
                     $edit_cat_id=escape($_GET['update']);
                          
                           $query="select * from category where cat_id='$edit_cat_id'";
                 $select_category=mysqli_query($connection,$query);
                    
                while($row=mysqli_fetch_assoc($select_category))
                    {
                                $cat_id=$row['cat_id'];
                                $cat_title=$row['cat_title'];
                                
                                 ?>
                                <label for="cat-title">Edit Category</label>
                                
                                 <input type="text"  class="form-control" name="cat_title" value="<?php echo $cat_title; ?>">
                                 
                             </div>
                              
                             <div class="form-group" >
                                 <input class="btn btn-primary" type="submit" name="update" value="Edit Category">
                                 <?php 
                      }
                      }
                                 ?>
                             </div>
                              
                              
                              
                          </form>
                          
                          
                      
                       <?php // edit query
                          if(isset($_POST['update']))
                          {
                              
                             $cat_title=escape($_POST['cat_title']);
                          
                          //echo $cat_title;
                        if($cat_title =="" || empty($cat_title)) 
                        {
                            
                            echo "This feild should not be empty!";
                        }
                          else
                          {
                              
                              
                             $query= "update category set cat_title='$cat_title' where cat_id={$get_cat_id1}";
                             
                             //echo $query;
                             //exit;
                              $edit_category=mysqli_query($connection,$query);
                              
                              if(!$edit_category)
                              {
                                  echo('Query failed'.mysqli_error($connection));
                              }
                          }
                          
                          }
                          
                          ?>   