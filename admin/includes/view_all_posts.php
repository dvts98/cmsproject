
<?php
include("delete_modal.php");
if(isset($_POST['checkBoxArray']))
{
    foreach($_POST['checkBoxArray'] as $checkBoxValue)
   {
   $bulk_options=$_POST['bulk_options'];    
  
        switch($bulk_options){
                
                case 'published':
                            $query="update posts set post_status='$bulk_options' where post_id={$checkBoxValue}";
                            $update_publish=mysqli_query($connection,$query);
                            confirm_query($update_publish);
                break;
                
                case 'draft':
                            $query="update posts set post_status='$bulk_options' where post_id={$checkBoxValue}";
                            $update_draft=mysqli_query($connection,$query);
                            confirm_query($update_draft);
                break;
                
                case 'delete':
                            $query="delete from posts  where post_id={$checkBoxValue}";
                            $update_delete=mysqli_query($connection,$query);
                            confirm_query($update_delete);
                break;
                
                case 'clone':
                            $query="select * from posts where post_id={$checkBoxValue}";
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
                                   //$post_date=date('d-m-y');
                    $post_comment_count=0;
                    $post_views_count=0;
                    
                }
                $query="insert into posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags
                ,post_status,post_comment_count,post_views_count)";
                $query.="values('{$post_category_id}','{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}','{$post_comment_count}','{$post_views_count}')";

                $create_query=mysqli_query($connection,$query);
                confirm_query($create_query);

                // confirm_query($update_delete);
                break;

         
                }

                }

                }


?>
<form action="" method="post">
<table class="table table-bordered table-hover">
                     
                  <div id="bulkOptionContainer"  class="col-xs-4" style="padding:0;">
                    <select class="form-control"  name="bulk_options" id="">
                       <option value="">Select Options</option>
                        <option value="published">Publish</option>
                        <option value="draft">Draft</option>
                        <option value="delete">Delete</option>
                        <option value="clone">Clone</option>
                    </select>
                      
                      
                  </div>
                    <div class="col-xs-4">
                        <input type="submit" name="submit" class="btn btn-success" value="Apply">
                        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                        
                    </div>
                     
                      <thead>
                          <tr>
                             <th><input id="selectAllBoxes" type="checkbox"</th>
                              <th>Id</th>
                              <th>Author</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Status</th>
                              <th>Image</th>
                              <th>Tags</th>
                              <th>Comments</th>
                              <th>Date</th>
                              <th>Post_Count</th>
                               <th>View Post</th>
                               <th>Edit</th>
                              <th>Delete</th>
                            
                          </tr>
                      </thead>
                      <tbody>
                         <?php
                          
                        //  $query="select * from posts  order by post_id desc";
                          
$query="select    posts.post_id,posts.post_author,posts.post_title,posts.post_user,posts.post_category_id,posts.post_status,posts.post_image,posts.post_tags,posts.post_comment_count,posts.post_date,posts.post_views_count, " ;
$query .="category.cat_id,category.cat_title ";
$query .="from posts ";
$query .=" LEFT JOIN  category ON posts.post_category_id =category.cat_id order by posts.post_id DESC";
                          //echo $query;
                          //exit;
                 $select_posts=mysqli_query($connection,$query);
                    
                while($row=mysqli_fetch_assoc($select_posts))
                    {
                                $post_id=$row['post_id'];
                                $post_title=$row['post_title'];
                                $post_author=$row['post_author'];
                                $post_date=$row['post_date'];
                                $post_image=$row['post_image'];
                               // $post_comment=$row['post_comment_count'];
                                $post_tags=$row['post_tags'];
                                $post_status=$row['post_status'];
                                $post_category_id=$row['post_category_id'];
                                $post_views_count=$row['post_views_count'];
                                $cat_id=$row['cat_id'];
                                $cat_title=$row['cat_title'];
                    
                    
                                $post_user=$row['post_user'];
                                $query="select * from users  where user_id='$post_user'";
                                $select_username=mysqli_query($connection,$query);
                                while($row1=mysqli_fetch_assoc($select_username))
                                     $post_user1=$row1['username'];

                         echo "<tr>";
                    ?>
                    <td><input  class='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id;?>"></td>
                        <?php
                    
                         echo "<td>$post_id</td>";
                    
                    if(!empty($post_author))
                    {
                         echo "<td>$post_author</td>";
                } else if(!empty($post_user))
                    {
                         echo "<td>$post_user1</td>";
                    }
                         echo "<td>$post_title</td>";
                    
                    // $query="select * from category where cat_id='$post_category_id'";
                    // $select_category=mysqli_query($connection,$query);
                     //confirm_query($select_category) ; 
                     //while($row=mysqli_fetch_assoc($select_category))
                    // {
                               // $cat_id=$row['cat_id'];
                               // $cat_title=$row['cat_title'];
                    
                    // }
                    
                    
                         echo "<td>{$cat_title}</td>";
                         echo "<td>$post_status</td>";
                         echo "<td><img width='100' src='../images/$post_image' alt='images'></td>";
                         echo "<td>$post_tags</td>";
                    
                        $query="select * from comments where comment_post_id={$post_id}";
                   
                        $select_comment=mysqli_query($connection,$query);
                        
                        $comment_count=mysqli_num_rows($select_comment);
                    
                         echo "<td><a href='post_comments.php?id={$post_id}'>$comment_count</a></td>";
                         echo "<td>$post_date</td>";
                         echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                         echo "<td><a  class='btn btn-info' href='../post.php?p_id={$post_id}'>View Post</a></td>";
                         echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                         echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link btn btn-danger'>Delete</a></td>";
                        // echo "<td><a onClick= \" javascript: return confirm('Are you sure you want to delete Message') ;\" href='posts.php?delete={$post_id}'>Delete</a></td>";
                    //header("location:posts.php");
                         echo "</tr>";
                               }
                          
                          ?>
                         
                      </tbody>
                  </table>
                  </form>
                  
                <?php

                if(isset($_GET['delete']))
                {


                if(isset($_SESSION['user_role']))
                {
                if($_SESSION['user_role'] == 'admin')
                {
                $the_post_id=mysqli_real_escape_string($connection,$_GET['delete']);

                $query="delete from posts where post_id={$the_post_id}";
                $delete_query=mysqli_query($connection,$query);
                header("location:posts.php");

                }else
               {
            
            echo "<h5>You Have No Rights to Delete a Comment</h5>";
               }
                }
                }


                if(isset($_GET['reset']))
                {
                $the_post_id=$_GET['reset'];

                $query="update posts set post_views_count=0 where post_id=".mysqli_real_escape_string($connection,$_GET['reset'])." ";
                $delete_query=mysqli_query($connection,$query);
                header("location:posts.php");


                }

                ?>
                <script>

                $(document).ready(function(){
                $(".delete_link").on('click',function(){

                var id=$(this).attr("rel");
                var delete_url="posts.php?delete="+ id +" ";
                $(".modal_delete_link").attr("href",delete_url);
                $("#myModal").modal('show');

                });





                });




                 </script>