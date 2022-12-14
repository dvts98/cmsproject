 
                     <table class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Author</th>
                              <th>Comment</th>
                              <th>Email</th>
                              <th>Status</th>
                              <th>In Response to</th>
                              <th>Date</th>
                              <th>Approve</th>
                              <th>Unapprove</th>
                               
                               <th>Delete</th>
                            
                          </tr>
                      </thead>
                      <tbody>
                    <?php

                    $query="select * from comments";
                    $select_comments=mysqli_query($connection,$query);

                    while($row=mysqli_fetch_assoc($select_comments))
                    {
                    $comment_id=$row['comment_id'];
                    $comment_post_id=$row['comment_post_id'];
                    $comment_author=$row['comment_author'];
                    $comment_content=$row['comment_content'];
                    $comment_email=$row['comment_email'];
                    //$post_content=substr($row['post_content'],0,50);
                    $comment_status=$row['comment_status'];
                    $comment_date=$row['comment_date'];


                    echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_content</td>";

                    // $query="select * from category where cat_id='$post_category_id'";
                    // $select_category=mysqli_query($connection,$query);
                    // confirm_query($select_category) ; 
                    // while($row=mysqli_fetch_assoc($select_category))
                    // {
                    // $cat_id=$row['cat_id'];
                    //  $cat_title=$row['cat_title'];

                    //  }


                    echo "<td>$comment_email</td>";
                    echo "<td>$comment_status</td>";
                    $query="select * from posts where post_id=$comment_post_id";

                    $select_post_id_query=mysqli_query($connection,$query);
                    $select_post_id_query1=mysqli_num_rows($select_post_id_query);
                    if($select_post_id_query1>'0'){
                    while($row=mysqli_fetch_assoc($select_post_id_query)){

                    $post_id=$row['post_id'];
                    $post_title=$row['post_title'];

                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                    }
                    }

                                 else
                    {
                    echo "<td>This Course is missing Now</td>";   

                    }   



                    echo "<td>$comment_date</td>";
                    echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                    echo "<td><a href='comments.php?unapprove=$comment_id'>UnApprove</a></td>";

                    echo "<td><a onClick= \" javascript: return confirm('Are you sure you want to delete Message') ;\" href='comments.php?delete=$comment_id & comment_post_id=$comment_post_id'>Delete</a></td>";
                    //header("location:posts.php");
                    echo "</tr>";
                    }

                    ?>
                         
                      </tbody>
                  </table>

                                 <?php

                    if(isset($_GET['approve']))
                    {
                    $the_post_id=escape($_GET['approve']);

                    $query="update comments set comment_status='Approved' where comment_id='$the_post_id'";
                    $delete_query=mysqli_query($connection,$query);
                    header("Location:comments.php");


                    }


                    if(isset($_GET['unapprove']))
                    {
                    $the_post_id=escape($_GET['unapprove']);

                    $query="update comments set comment_status='Unapproved' where comment_id='$the_post_id'";
                    $delete_query=mysqli_query($connection,$query);
                    header("Location:comments.php");


                    }


                    if(isset($_GET['delete']))
                    {
                        if(isset($_SESSION['user_role']))
    {
        if($_SESSION['user_role'] == 'admin')
        {
                    $the_comment_id=mysqli_real_escape_string($connection,$_GET['delete']);
                      $comment_post_id=$_GET['comment_post_id'];

                    $query="delete from comments where comment_id={$the_comment_id}";
                    $delete_query=mysqli_query($connection,$query);
                   // $query ="update posts set post_comment_count=post_comment_count-1 ";
                               // $query .="where post_id={$comment_post_id}";
                                    //echo $query;
                                    //exit;
                                   // $update_query=mysqli_query($connection,$query);
                    header("Location:comments.php");
        }
                        }

                    }
                                    ?>