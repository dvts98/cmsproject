                    <?php


 function escape($string){
                    global $connection; 
                    return mysqli_real_escape_string($connection,trim($string));   

                       }


 function users_online()
                        {


                    if(isset($_GET['onlineusers'])){
                    //echo "hi";
                    global $connection;
                    if(!$connection){

                    session_start();
                    include("../includes/db.php"); 

                    $session=session_id();
                    $time=time();
                    $time_out_in_seconds=30;
                    $time_out=$time-$time_out_in_seconds;

                    $query="select * from users_online where session='$session'";
                    $send_query=mysqli_query($connection,$query);
                    $count=mysqli_num_rows($send_query);
                    if($count== NULL){


                    mysqli_query($connection,"insert into users_online(session,time) values('$session','$time')");
                    }
                    else
                    {

                    mysqli_query($connection,"update users_online set time='$time' where session='$session'");  
                    }
                    $users_online_query=mysqli_query($connection,"select * from users_online where time > '$time_out'");
                    echo $count_user=mysqli_num_rows($users_online_query);
                    }
                    }//get request
                    }
                    users_online();


function insert_category(){

                    global $connection;

                    if(isset($_POST['submit']))
                    {

                    $cat_title=$_POST['cat_title'];

                    //echo $cat_title;
                    if($cat_title =="" || empty($cat_title)) 
                    {

                    echo "This feild should not be empty!";
                    }
                    else
                    {
                    $query= "insert into category(cat_title) " ;
                    $query.=" value ('{$cat_title}')";
                    //echo $query;
                    //exit;
                    $create_category=mysqli_query($connection,$query);

                    if(!$create_category)
                    {
                    echo('Query failed'.mysqli_error($connection));
                    }
                    }

                    }
                    }


function confirm_query($result)
                    {
                    global $connection;
                    if(!$result)
                    {

                    die('Query Failed.'.mysqli_error($connection));
                    }

                    }

 function findallcategory()
                    {
                    global $connection;
                    $query="select * from category";
                    $select_category=mysqli_query($connection,$query);

                    while($row=mysqli_fetch_assoc($select_category))
                    {
                    $cat_id=$row['cat_id'];
                    $cat_title=$row['cat_title'];

                    echo "<tr>";                     
                    echo "<td>{$cat_id}</td>";           
                    echo "<td>{$cat_title}</td>";
                    echo "<td><a class='btn btn-danger' onClick= \" javascript: return confirm('Are you sure you want to delete Message') ;\" href='category.php?delete={$cat_id}'>Delete</a></td>";
                    echo "<td><a class='btn btn-info' href='category.php?update={$cat_id}'>Update</a></td>";
                    echo "</tr>"; 
                    }

                    }

 function delete_category()
                    {
                    global $connection;

                    if(isset($_GET['delete']))
                    {
                       // session_start();
                        if($_SESSION['user_role'] == 'admin')
                { 
                    $get_cat_id=$_GET['delete'];
                    $query="delete from category where cat_id={$get_cat_id}";
                    $delete_category=mysqli_query($connection,$query);
                    header("Location:category.php");

                        }
                else
                {

                echo "<h5>You Have No Rights to Delete a Comment</h5>";
                }   
                    }

                    }

////redirect function////
function redirect($location){
                    return header("Location: " . $location);


                    }
/////take count of all table for index page/////
function recordCount($table){
                    global $connection;
                    $query="SELECT * FROM " .$table ;
                    $Select_all_posts=mysqli_query($connection,$query);
                    $result=mysqli_num_rows($Select_all_posts);  
                    confirm_query($result);
                    return $result;

                    }
//check status for admin index page////
function checkStatus($table,$column,$status){
                    global $connection;
                    $query="SELECT * FROM $table where $column='$status'" ;
                    $result=mysqli_query($connection,$query);
                    return  mysqli_num_rows($result);
    
       
}
//check user role///
function is_admin($username = ''){
    
                    global $connection;
                    $query="select user_role from users where username='$username'";
                    $result=mysqli_query($connection,$query);
                    confirm_query($result);
                    $row=mysqli_fetch_array($result);
                    if($row['user_role']=='admin')
                    {
                     return true;   
                    } else{

                      return false;  
                    }


    
    
}
//username checks//
function username_exists($username){
    
                    global $connection;
                    $query="select username from users where username='$username'";
                    $result=mysqli_query($connection,$query);
                    confirm_query($result);
                    if(mysqli_num_rows($result)>0){

                      return true;   
                    } else{

                      return false;    


                    }


    
    
}
//email exits check
function useremail_exists($email){
    
                    global $connection;
                    $query="select user_email from users where user_email='$email'";
                    $result=mysqli_query($connection,$query);
                    confirm_query($result);
                    if(mysqli_num_rows($result)>0){

                      return true;   
                    } else{

                      return false;    


                    }
    
    
    
    
}
//registration users///
function register_user($username,$email,$password){
    
                    global $connection;
                    $username = mysqli_real_escape_string($connection, $username);
                    $email    = mysqli_real_escape_string($connection, $email);
                    $password = mysqli_real_escape_string($connection, $password);


                    $password=password_hash( $password, PASSWORD_BCRYPT,array('cost'=>12));

                    if(!empty($username) && !empty($email) && !empty($password))  
                    {
                    $query="insert into users(`username`, `user_password`,`user_email`,user_role)";

                    $query.="values('{$username}','{$password}','{$email}','subscriber')";

                    $create_query=mysqli_query($connection,$query);
                    confirm_query($create_query);   
                    }
        
    
}
 
//login user    
 function login_user($username,$password){
                    global $connection;
                    $username= trim($username);
                    $email= trim($email);
                    $username = mysqli_real_escape_string($connection, $username);
                    $password = mysqli_real_escape_string($connection, $password);

                    $query = "SELECT * FROM users WHERE username = '{$username}' ";
                    $select_user_query = mysqli_query($connection, $query);
                    if (!$select_user_query) {

                    die("QUERY FAILED" . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($select_user_query)) {
                    $db_id = $row['user_id'];
                    $db_username = $row['username'];
                    $db_user_password = $row['user_password'];
                    $db_user_firstname = $row['user_firstname'];
                    $db_user_lastname = $row['user_lastname'];
                    $db_user_role = $row['user_role'];
                    }
                   if (password_verify($password,$db_user_password)) {
                    if (session_status() == PHP_SESSION_NONE) session_start(); // --> I added this line, it will check if session is started and if it is not it will start it. <--
                    $_SESSION['username'] = $db_username;
                    $_SESSION['firstname'] = $db_user_firstname;
                    $_SESSION['lastname'] = $db_user_lastname;
                    $_SESSION['user_role'] = $db_user_role;

                    redirect("/cms/admin");
                    } else {

                    redirect("/cms/index.php");
                    }
     
     
     
     
 }   
    

    
                    ?>