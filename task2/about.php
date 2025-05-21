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
</head>
<body id="ia">
<?php include 'header.php'; ?>
<div class="line2"></div>
<div class="banner">
            <div class="detail">
                <h1>about us</h1>
                <p>>Discover the essence of nature with our premium honey. Each jar is a testament to our dedication to quality and sustainability, meticulously harvested to deliver a rich and authentic flavor. Experience the unparalleled taste and numerous health benefits of our natural honey, crafted with care just for you.</p><br>
                <br><a href="index1.php">home</a><span>/about us</span>
            </div>
        </div>
        <div class="line3"></div>
        <div class="about-us">
            <div class="row">
                <div class="r">
                <div class="title">
                   <span>ABOUT OUR ONLINE STORE</span> 
                   <h1>Hello,with 25 years of experience</h1>   
                 </div>
                   <p>Welcome to our online store, where we bring 25 years of expertise in delivering high-quality products right to your doorstep.
                     Our journey began with a simple mission: to provide exceptional products and outstanding customer service. Over the years, we have 
                     grown and evolved, but our commitment to quality and customer satisfaction remains unwavering. Explore our wide range of carefully curated items, 
                    each selected with care to ensure you receive only the best. Thank you for choosing us as your trusted source for all your needs</p>
             </div>
             <div class="img-box">
                 <img src="./image/th (17).jpeg" alt="photo">
             </div>
           </div>
        </div>
        <div class="features">
            <div class="title">
                <h1>Complete customer Ideas</h1>
                 <span>best features</span>
            </div>
            <din class="row">
               <div class="box">
                <img src="./image/th (11).jpeg">
                <h4>24 X 7</h4>
                <p>Online Support 27/7</p>
            </div>
               <div class="box">
                <img src="./image/150-1501872_100-money-back-guarantee-circle-clipart.png">
                <h4>Money Back Guarantee</h4>
                <p>100% Secure Payment</p>
            </div>
               <div class="box">
                <img src="./image/pngtree-free-gift-vector-ilustration-png-image_8498394.png">
                <h4>Special Gift Card</h4>
                <p>Give the perfict Gift</p>
            </div>
               <div class="box">
                <img src="./image/88134.png">
                <h4>Worldwide Shipping</h4>
                <p>On Order Over $99</p>
            </div>
            </din>
        </div>
        <div class="team">
            <div class="title">
                    <h1>Our Workable Team</h1>
                    <span>best team</span>
            </div>
            <div class="row">
                <div class="box">
                    <div class="img-box">
                    <img src="./image/th (18).jpeg">
                </div>
                <div class="detail">
                    <span>Finace Manager</Main></span>
                    <h4>Miguel Rodregez</h4>
                    <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-behance"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
                </div>
                </div>
                <div class="box">
                    <div class="img-box">
                    <img src="./image/TQ96K10SC7OEYNJSRO9D80.jpg">
                </div>
                <div class="detail">
                    <span>Finace Manager</Main></span>
                    <h4>Miguel Rodregez</h4>
                    <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-behance"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
                </div>
                </div>
                <div class="box">
                    <div class="img-box">
                    <img src="./image/127715041.jpg">
                </div>
                <div class="detail">
                    <span>Finace Manager</Main></span>
                    <h4>Miguel Rodregez</h4>
                    <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-behance"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
                </div>
                </div>
                <div class="box">
                    <div class="img-box">
                    <img src="./image/th (19).jpeg">
                </div>
                <div class="detail">
                    <span>Finace Manager</Main></span>
                    <h4>Miguel Rodregez</h4>
                    <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-behance"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
                </div>
                </div>
                <div class="box">
                    <div class="img-box">
                    <img src="./image/th (20).jpeg">
                </div>
                <div class="detail">
                    <span>Finace Manager</Main></span>
                    <h4>Miguel Rodregez</h4>
                    <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-behance"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
                </div>
                </div>
            </div>
        </div>
        <div class="line3"></div>
        <div class="project">
            <div class="title">
                <h1>Our Best Project</h1><br>
                <span>how it works</span>
            </div>
            <div class="row">
                <div class="box">
                   <img src="./image/th (22).jpeg"> 
                </div>
                <div class="box">
                   <img src="./image/th (21).jpeg"> 
                </div>
                <div class="box">
                   <img src="./image/GettyImages-629296762-5bc8f5cfc9e77c00516143b4.jpg"> 
                </div>
            </div>
        </div>
        <div class="line3"></div>
        <div class="ideas">
            <div class="title">
                <h1>We And Our Clients Happy To Cooperate With Our Company</h1>
                <span>our features</span>
            </div>
            <div class="row">
    <div class="box">
        <div class="detail">
            <i class="bi bi-stack"></i>
            <h2>What We Really Do</h2>
            <p>We are dedicated to producing pure, natural honey by embracing sustainable beekeeping practices. Our focus is on preserving the health of our bees and the environment, ensuring that every jar of honey is not only delicious but also responsibly sourced.</p>
        </div>
    </div>
    <div class="box">
        <div class="detail">
            <i class="bi bi-grid-1x2-fill"></i>
            <h2>History of Beginning</h2>
            <p>Our journey began with a deep love for nature and a commitment to quality. From a small local farm, we have grown into a trusted provider of natural honey, always adhering to our original values of purity and sustainability.</p>
        </div>
    </div>
    <div class="box">
        <div class="detail">
            <i class="bi bi-tropical-storm"></i>
            <h2>Our Vision</h2>
            <p>Our vision is to lead the way in sustainable honey production, promoting environmental stewardship and contributing to the well-being of our planet. We aim to inspire others to appreciate the importance of natural products and the vital role bees play in our ecosystem.</p>
        </div>
    </div>
</div>
        </div>
        <div class="line3"></div>
        <div class="line3"></div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>