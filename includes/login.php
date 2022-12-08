<?php include "db.php"; ?>
<?php session_start(); ?>
 
<?php
 
if (isset($_POST['login'])) {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 
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
 
    // Fetch salt:
    // --->
   // $query = "SELECT randSalt FROM users";
   // $select_randSalt_query = mysqli_query($connection, $query);
    //if (!$select_randSalt_query) {
   //     die("Query Failed" . mysqli_error($connection));
   // }
 
   // $row = mysqli_fetch_array($select_randSalt_query);
   // $salt = $row['randSalt'];
    // <--
 
   // $password = crypt($password, $salt);
   // $password=password_hash( $password, PASSWORD_BCRYPT,array('cost'=>12));
 
    if (password_verify($password,$db_user_password)) {
        if (session_status() == PHP_SESSION_NONE) session_start(); // --> I added this line, it will check if session is started and if it is not it will start it. <--
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
 
        header("Location: ../admin ");
    } else {
 
        header("Location: ../index.php ");
    }
}
 
?>