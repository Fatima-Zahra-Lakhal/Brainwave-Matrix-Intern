<?php
    include 'conection.php'; 
    if (isset($_POST['submit-btn'])) {
        $filter_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $name = mysqli_real_escape_string($conn, $filter_name);
        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
        $email = mysqli_real_escape_string($conn, $filter_email);
        $filter_password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
        $password = mysqli_real_escape_string($conn, $filter_password);
        $filter_cpassword = htmlspecialchars($_POST['cpassword'], ENT_QUOTES, 'UTF-8');
        $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);
        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email'") or die('query failed');
        if (mysqli_num_rows($select_user) > 0) {
            $message[] = 'User already exists';
        } else {
            if ($password != $cpassword) {
                $message[] = 'Passwords do not match';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name', '$email', '$hashed_password')") or die('query failed');
                $message[] = 'Registered successfully';
                header('location:login.php');
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-with , inital-scale=1.0">
        <link rel="icon" type="image/x-icon" href="icon.png">
        <title>Regester page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <section class="form-container">
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
            <form method="post">
                <h1>register now</h1>
                <input type="text" name="name" placeholder="enter your name" required>
                <input type="email" name="email" placeholder="enter your email" required>
                <input type="password" name="password" placeholder="entrer your password" required>
                <input type="password" name="cpassword" placeholder="confirm your password" requird>
                <input type="submit" name="submit-btn" value="register now" class="btn">
                <p>already have an account ? <a href="login.php"> login now</a></p>
            </form>
        </section>      
    </body>
</html>