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
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'image/' . $image;
    if (!file_exists('image/')) {
        mkdir('image/', 0755, true);
    }
    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name='$product_name'") or die('Query failed');
    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Product name already exists';
    } else {
        if ($image_size > 2000000) {
            $message[] = 'Image size is too large';
        } else {
            $insert_product = mysqli_query($conn, "INSERT INTO `products` (`name`, `price`, `product_detail`, `image`) 
            VALUES('$product_name', '$product_price', '$product_detail', '$image')") or die('Query failed');
            if ($insert_product) {
                if (!move_uploaded_file($image_tmp_name, $image_folder)) {
                    $error = error_get_last();
                    $message[] = 'Failed to move uploaded file. Error: ' . $error['message'];
                } else {
                    $message[] = 'Product added successfully';
                }
            }
        }
    }
}

if(isset($_GET['delete'])){
    $delete_id= $_GET['delete'];
    $select_delete_image=mysqli_query($conn,"SELECT image FROM products WHERE id='$delete_id'")or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('image/'.$fetch_delete_image['image']);
    mysqli_query($conn,"DELETE FROM products WHERE id='$delete_id'")or die('query failed');
    mysqli_query($conn,"DELETE FROM cart WHERE pid='$delete_id'")or die('query failed');
    mysqli_query($conn,"DELETE FROM wishlist WHERE pid='$delete_id'")or die('query failed');
    header('location:admin_product.php');
}else{
    echo '<div class="empty><p>no products added yet!</p>
    </div>';
}
if (isset($_POST['update_product'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];
    $update_detail = $_POST['update_detail'];
    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'image/' . $update_image;
    $update_query = mysqli_query($conn, "UPDATE `products` SET `name`='$update_name', `price`='$update_price', `product_detail`='$update_detail', `image`='$update_image' WHERE `id`='$update_id'") or die('query failed');
    if ($update_query) {
        move_uploaded_file($update_image_tmp_name, $update_image_folder);
        header('Location: admin_product.php');
        exit();
    }
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
<title>Admin product</title>
</head>
<body id="lakhal">
    <?php include 'admin_header.php'?>
  
      <div class="line2"></div>
      <div class="product">
            <div class="add">
                <h1>add your product</h1>
                <p>Our honey must be meticulously sourced and manufactured to deliver unparalleled quality, ensuring every jar is filled with the purest, most flavorful honey that nature has to offer.</p>
            </div>
        </div> 
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
      <section class="add-products form-container">
        <div class="t">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="input-field">
                <label>product name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-field">
                <label>product price</label>
                <input type="text" name="price" required>
            </div>
            <div class="input-field">
                <label>product detail</label>
                <input type="text" name="detail" required>
            </div>
            <div class="input-field">
                <label>product image</label>
                <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp" required>
            </div>
            <input type="submit" name="add_product" walue="add product" class="btn">
        </form>
    </div>
      </section>
      <div class="line3"></div>
      <div class="line4"></div>
            <div class="aadd">
                <h1>The products that has been registered </h1>
            </div>
      <section class="show-products">
        <div class="box-container">
            <?php $select_products =mysqli_query($conn,"SELECT * FROM `products`") or die('deury failed');
            if(mysqli_num_rows($select_products)>0){
                 while($fetch_products=mysqli_fetch_assoc($select_products)){
                ?>
<div class="box">
        <img src="image/<?php echo $fetch_products['image']; ?>" alt="Product Image">
        <div id="hi">
        <p>Price: <?php echo $fetch_products['price']."DH"; ?></p>
        <h4><?php echo $fetch_products['name']; ?></h4>
        <details><?php echo $fetch_products['product_detail']; ?></details>
        <a href="admin_product.php?edit=<?php echo $fetch_products['id'];?>" class="edit">edit</a>
        <a href="admin_product.php?delete=<?php echo $fetch_products['id'];?>" class="delete" onclick="return confirm('want to delete this product');">delete</a>
    </div>
</div>
        <?php 
                 }
           }else{
            echo'
               <div class="empty">
            <p>product added yet!</p>
        </div>';
           }
        ?>
        
      </section>
      <div class="line"></div>
      <section class="update-container">
    <?php
    if (isset($_GET['edit'])) {
        $edit_id = $_GET['edit'];
        $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$edit_id'") or die('query failed');
        if (mysqli_num_rows($edit_query) > 0) {
            while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
    ?>
    <form method="POST" enctype="multipart/form-data">
        <img src="image/<?php echo $fetch_edit['image']; ?>" alt="Product Image">
        <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
        <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
        <input type="number" name="update_price" min="0" value="<?php echo $fetch_edit['price']; ?>">
        <textarea name="update_detail"><?php echo $fetch_edit['product_detail']; ?></textarea>
        <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png, image/webp">
        <input type="submit" name="update_product" value="Update" class="edit">
        <input type="reset" name="" value="Cancel" class="option-btn btn" id="close-form">
    </form>
   <script> document.addEventListener('DOMContentLoaded', () => {
            let closeBtn = document.querySelector('#close-form');
            closeBtn.addEventListener('click', () => {
                document.querySe
                lector('.update-container').style.display = 'none';
            });
            document.querySelector('.update-container').style.display = 'block';
        }); </script>
    <?php
            }
        }
    }
    ?>
</section>
    <script type="text/javascript" src="script.js"></script>
</body> 
</html>