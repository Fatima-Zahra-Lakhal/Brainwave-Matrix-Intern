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
    mysqli_query($conn,"DELETE FROM `message` WHERE id='$delete_id'")or die('query failed');
    header('location:admin_message.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/x-icon" href="icon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin order</title>
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
        <h1 class="title">unread message</h1>
        <div class="box-container">
            <?php 
            $select_message=mysqli_query($conn,"SELECT * FROM `message`")or die('query failed');
            if(mysqli_num_rows($select_message)>0){
                while($fetch_message = mysqli_fetch_assoc($select_message)){
                    ?>
            <div class="box">
                <p>user id :<span><?php echo $fetch_message['id'];?></span></p>
                <p>user name :<span><?php echo $fetch_message['name'];?></span></p>
                <p>user email :<span><?php echo $fetch_message['email'];?></span></p>
                <p><?php echo $fetch_message['message'];?></p><br>
                <a href="admin_message.php?delete=<?php echo $fetch_message['id'];?>" onclick="return confirm('want to delete this message');" class="delete">delete</a>
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