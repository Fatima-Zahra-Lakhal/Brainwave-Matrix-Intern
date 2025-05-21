<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="main.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <title>Home Page</title>
</head>
<body>
    <section class="popilar-brands">
    <h2>POPULAR BRANDS</h2>
    <div class="controls">
        <i class="bi bi-chevron-left left"></i>
        <i class="bi bi-chevron-right right"></i>
    </div>
    <div class="popilar-brands-content">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die("Query failed");
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
        <form method="post" class="card">
            <div class="ligne">
            <img src="image/<?php echo $fetch_products['image']; ?>" alt="<?php echo htmlspecialchars($fetch_products['name']); ?>">
            <div class="price"><?php echo htmlspecialchars($fetch_products['price']); ?>DH</div>
            <div class="name"><?php echo htmlspecialchars($fetch_products['name']); ?></div>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($fetch_products['id']); ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['name']); ?>">
            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['price']); ?>">
            <input type="hidden" name="product_quantity" value="1" min="1">
            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['image']); ?>">
        </div>
            <div class="icon">
             <a href="view_page.php?pid=<?php echo htmlspecialchars($fetch_products['id'], ENT_QUOTES, 'UTF-8'); ?>" class="bi bi-eye fill"></a>
                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
            </div>
        </form>
        <?php       
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
    </div>
</section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript">
        $('.popilar-brands-content').slick({
            lazyLoad: 'ondemand',
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: $('.left'),
            nextArrow: $('.right'),
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
</body>
</html>
