<?php
include 'conection.php';
session_start();
$admin_id = $_SESSION['admin_name'];
if (!isset($admin_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    exit();
}
if(isset($_GET['delete'])){
    $delete_id= $_GET['delete'];
    mysqli_query($conn,"DELETE FROM `users` WHERE id='$delete_id'")or die('query failed');
    $message[]='user removed successfuly';
    header('location:admin_user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/x-icon" href="icon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<meta name="viewport" content="width=device-width , initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<title>total users account</title>
</head>
<body id="ff">
    <?php include 'admin_header.php'?>
    <?php
             if(isset($message)){
                foreach ($message as $mes){
                   echo'
                    <div class="message">
                        <span>'.$mes.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>';
                }
             }
             ?>
      <div class="line2"></div>
      <section class="message-container">
        <h1 class="title">totale users</h1>
        <div class="box-container">
            <?php 
            $select_users=mysqli_query($conn,"SELECT * FROM `users`")or die('query failed');
            if(mysqli_num_rows($select_users)>0){
                while($fetch_users= mysqli_fetch_assoc($select_users)){
                    ?>
            <div class="box">
                <p>user id :<span><?php echo $fetch_users['id'];?></span></p>
                <p>user name :<span><?php echo $fetch_users['name'];?></span></p>
                <p>user email :<span><?php echo $fetch_users['email'];?></span></p>
                <p>user type :<span style="color: <?php if($fetch_users['user_type']=='admin'){echo 'white';};?>"><b><?php echo $fetch_users['user_type'];?></b></span></p><br>
                <a href="admin_user.php?delete=<?php echo $fetch_users['id'];?>" onclick="return confirm('want to delete this user');" class="delete">delete</a>
            </div>
               <?php     
                }
            }else{  echo '<div class="empty"><p>no messages found!</p></div>';}
            ?>
        </div>
      </section>
    <script type="text/javascript" src="script.js"></script>
</body> 
</html>