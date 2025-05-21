<?php
include 'conection.php';
session_start();

$user_id = $_SESSION['user_name'];
if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    exit();
}
if (isset($_POST['add_to_wishlist'])) {
    $product_id=$_POST['product_id'];
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_POST['product_image'];
    $wishlist_numbrer=mysqli_query($conn,"SELECT * FROM `wishlist` WHERE name='$product_name' AND user_id='$user_id'")or die ('query failed');
    $cart_numr=mysqli_query($conn,"SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'")or die ('query failed');
    if(mysqli_num_rows($wishlist_numbrer)>0){
        $message[]="product already exist in wishlist";    
    }else if(mysqli_num_rows($cart_numr)>0){
        $message[]="product already exist in cart";
    }else{
        mysqli_query($conn,"INSERT INTO `wishlist` (`user_id`,`pid`,`name`,`price`,`image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_image')");
        $message[]="product successfuly added in your wishlist";
    }
}
if (isset($_POST['add_to_cart'])) {
    $product_id=$_POST['product_id'];
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_POST['product_image'];
    $product_quantity=$_POST['product_quantity'];
    $cart_numr=mysqli_query($conn,"SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'")or die ('query failed');   
    if(mysqli_num_rows($cart_numr)>0){
        $message[]="product already exist in cart";
    }else{
        mysqli_query($conn,"INSERT INTO `cart` (`user_id`,`pid`,`name`,`price`,`quantity`,`image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
        $message[]="product successfuly added in your cart";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="main.css"> <!-- Inclure le CSS principal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
            <img src="./image/icon.png" alt="Hero Image">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium <br> Honey</h1>
                    <p>Enjoy sweet, aromatic honey made by hardworking people from <br> ecological clean raw materials in the most pure environment</p>
                    <a href="shop.php" class="btn">SHOP NOW</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="./image/Honey-PNG-File.png" alt="Honey Image">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium <br> Honey</h1>
                    <p>Enjoy sweet, aromatic honey made by hardworking people from <br> ecological clean raw materials in the most pure environment</p>
                    <a href="shop.php" class="btn">SHOP NOW</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="./image/honey-png-11553987315bmprujy8zf.png" alt="Honey Image">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium <br> Honey</h1>
                    <p>Enjoy sweet, aromatic honey made by hardworking people from <br> ecological clean raw materials in the most pure environment</p>
                    <a href="shop.php" class="btn">SHOP NOW</a>
                </div> 
            </div>
            <div class="slider-item">
                <img src="./image/th__3_-removebg-preview.png" alt="Honey Image">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium <br> Honey</h1>
                    <p>Enjoy sweet, aromatic honey made by hardworking people from <br> ecological clean raw materials in the most pure environment</p>
                    <a href="shop.php" class="btn">SHOP NOW</a>
                </div>
            </div>
            
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
    </div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="./image/250-2506303_product-logo-cargo-ship-portable-network-graphics-fast-removebg-preview.png">
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>"Get Your Orders with Blazing Fast Free Shipping_No Minimum Purchase!"</p>
                </div>
            </div>
            <div class="box">
                <img src="./image/Money-back-guarantee-rubber-label-stamp-seal-on-transparent-background-PNG-removebg-preview.png">
                <div>
                    <h1>Money Back & Guarantee</h1>
                    <p> Blazing Fast Free Shipping & Money-Back Guarantee!"</p>
                </div>
            </div>
            <div class="box">
                <img src="./image/th__11_-removebg-preview.png">
                <div>
                    <h1>online Suport 24/7</h1>
                    <p>"24/7 Online Support: We're Here for You Anytime, Day or Night!"</p>
                </div>
            </div>
        </div>
    </div>
     <div class="story">
        <div class="row">
            <div class="box">
                <span>Honey in Contemporary Times</span>
                <h1>Honey Today: Balancing Tradition, Innovation, and Environmental Challenges"</h1>
                <p>Today, honey is enjoyed worldwide, both for its culinary uses and its numerous health benefits. It is celebrated for its natural sweetness, versatility in recipes, and unique flavor profiles influenced by the plants from which the bees collect nectar. Honey is also recognized
                     for its medicinal properties, with uses ranging from soothing sore throats to promoting wound healing.</p>
                <p>Beekeeping has become an important agricultural industry, with millions of beehives worldwide. However, in recent years, the beekeeping industry has faced challenges, such as colony collapse disorder, which threatens the population of honeybees and, consequently, honey production. The importance of honeybee conservation and sustainable beekeeping practices
                     has gained considerable attention to ensure the continued availability of honey for future generations.</p>
                <p>In conclusion, honey’s history is a rich tapestry that spans across cultures, civilizations, and centuries. It has been revered as a gift from the gods, a symbol of wealth and longevity, a staple of medieval monastic life, and a beloved ingredient in modern kitchens. As we continue to appreciate the diverse uses of honey, we must also take steps to protect the invaluable 
                    honeybees and the ecosystems that sustain them, ensuring that the story of honey continues to be written for generations to come.</p>
                 <a href="shop.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="./image/Honey-No-Background (1).png">
                </div>
        </div>
     </div>
     <div class="testimonial-fluid">
        <h1 class="title">What Our Customers Say</h1>
        <div class="testimonial-slider">
            <div class="testimonial-item">
                <img src="./image/th (13).jpeg" alt="Customer Testimonial 1">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>This honey is absolutely amazing! It's rich in flavor and completely natural. We've tried many brands, but this one stands out for its purity and quality. Highly recommended!</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="./image/th (12).jpeg" alt="Customer Testimonial 2">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>I love using this honey in my tea and baking. It adds the perfect touch of sweetness without being overpowering. You can really taste the difference in quality!</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="./image/th (15).jpeg" alt="Customer Testimonial 3">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>From the first spoonful, I was hooked. This honey has a wonderful texture and flavor that makes it a staple in our kitchen. It's fantastic on toast, in smoothies, or even straight from the jar.</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="./image/th (14).jpeg" alt="Customer Testimonial 4">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>I've been searching for a high-quality honey for a while, and I'm so glad I found this one. It's everything I hoped for and more. Perfect for health-conscious individuals looking for a natural sweetener.</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="./image/stock-person-png-stock-photo-man-11563049686zqeb9zmqjd.png" alt="Customer Testimonial 5">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>The best honey I've ever tasted. It's smooth, delicious, and you can tell it's made with care. I'll definitely be purchasing again.</p>
                </div>
            </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev1"></i>
            <i class="bi bi-chevron-right next1"></i>
        </div>
    </div>
    <div class="discover">
        <div class="detail">
            <h1 class="title">Organic Honey be Healthy</h1>
            <span>bay Now and Save 30% off!</span>
            <p>Our organic honey is harvested from the finest flowers, ensuring a rich and natural flavor with every spoonful. Not only is it delicious, 
                but it's also packed with antioxidants and nutrients that boost your health. Perfect for sweetening your tea, drizzling over 
                yogurt, or even enjoying straight from the jar. Take advantage of our limited-time offer and start your journey to a healthier lifestyle today!</p><br>
                <a href="shop.php" class="btn">discover now</a>
        </div>
        <div class="img-box">
             <img src="./image/honey-clipart-honey-jar-12.png">
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
             } ?>
    <?php include 'homeshop.php'; ?>
    <div class="newslatter">
        <h1 class="title">Join Our To Newslatter</h1>
        <p>Get 15% off your next order.Be the first to learn about promotions specail events, new arrivals and mor</p>
        <input type="text" name="" placeholder="your email address ...">
        <button>subscribe now</button>
    </div>
    <div class="client">
        <div class="box">
            <img src="./image/lg1.png">
        </div>
        <div class="box">
            <img src="./image/lg2.png">
        </div>
        <div class="box">
            <img src="./image/lg3.png">
        </div>
        <div class="box">
            <img src="./image/lg4.png">
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.hero-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: $('.controls .prev'),
                nextArrow: $('.controls .next'),
                dots: true, // Optionnel
                autoplay: true, // Optionnel
                autoplaySpeed: 3000 // Optionnel
            });
        });
        $(document).ready(function(){
            $('.testimonial-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: $('.controls .prev1'),
                nextArrow: $('.controls .next1'),
                dots: true, // Optionnel
                autoplay: true, // Optionnel
                autoplaySpeed: 3000 // Optionnel
            });
        });
    
    </script>
</body>
</html>
