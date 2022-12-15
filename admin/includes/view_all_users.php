
                     <table class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>UserName</th>
                              <th>FirstName</th>
                              <th>LastName</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Change Role</th>
                              <th>Change Role</th>
                               <th>Edit</th>
                             <th>Delete</th>
                          </tr>
                      </thead>
                      <tbody>
                         <?php
                          
                          $query="select * from users";
                 $select_users=mysqli_query($connection,$query);
                    
                while($row=mysqli_fetch_assoc($select_users))
                    {
                                $user_id=$row['user_id'];
                                $username=$row['username'];
                                $user_password=$row['user_password'];
                                $user_firstname=$row['user_firstname'];
                                $user_lastname=$row['user_lastname'];
                                //$post_content=substr($row['post_content'],0,50);
                                $user_email=$row['user_email'];
                                $user_image=$row['user_image'];
                                $user_role=$row['user_role'];
                                
                 
                         echo "<tr>";
                         echo "<td>$user_id</td>";
                         echo "<td>$username</td>";
                         echo "<td>$user_firstname</td>";
                         echo "<td>$user_lastname</td>";
                    
                    // $query="select * from category where cat_id='$post_category_id'";
                    // $select_category=mysqli_query($connection,$query);
                    // confirm_query($select_category) ; 
                    // while($row=mysqli_fetch_assoc($select_category))
                    // {
                               // $cat_id=$row['cat_id'];
                              //  $cat_title=$row['cat_title'];
                    
                   //  }
                    
                    
                         echo "<td>$user_email</td>";
                         echo "<td>$user_role</td>";
                   /* $query="select * from posts where post_id=$comment_post_id";
                    
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
                
                         echo "<td>$comment_date</td>";*/
                        echo "<td><a  class='btn btn-info' href='users.php?update_admin=$user_id'>Admin</a></td>";
                         echo "<td><a  class='btn btn-info' href='users.php?update_sub=$user_id'>Subscriber</a</td>";
                    echo "<td><a class='btn btn-info' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                         echo "<td><a class='btn btn-danger' onClick= \" javascript: return confirm('Are you sure you want to delete Message') ;\"  href='users.php?delete=$user_id'>Delete</a></td>";
             
                         echo "</tr>";
                               }
                          
                          ?>
                         
                      </tbody>
                  </table>
                  
                 <?php

if(isset($_GET['update_admin']))
{
    $the_post_id=escape($_GET['update_admin']);
    
    $query="update users set user_role='admin' where user_id='$the_post_id'";
    $delete_query=mysqli_query($connection,$query);
    header("Location:users.php");
    
    
}


if(isset($_GET['update_sub']))
{
    //echo "hi";
    //exit;
    $the_post_id=escape($_GET['update_sub']);
    
     $query="update users set user_role='subscriber' where user_id='$the_post_id'";
    $delete_query=mysqli_query($connection,$query);
    header("Location:users.php");
    
    
}


if(isset($_GET['delete']))
    
{
    if(isset($_SESSION['user_role']))
    {
        if($_SESSION['user_role'] == 'admin')
        {
    $the_user_id=mysqli_real_escape_string($connection,$_GET['delete']);
    
    $query="delete from users where user_id = {$the_user_id}";
    $delete_query=mysqli_query($connection,$query);
   
    header("Location:users.php");
    }
    }
}
                    ?>