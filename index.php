<?php session_start();?>
<?php $connect = new MySQLi('localhost','root','','qly_web'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">

</head>
<body>
<section class="myheader">
    <?php include"views/layout/header.php"; ?>
</section>
<!--end header-->
<section class="mymainmenu bg-danger mb-1">
    <?php include"views/layout/menu-top.php"; ?>
</section>
<!-- end menu -->
<!-- start home -->
<?php
    if(isset($_GET['option'])){
        switch($_GET['option']){   
            case'home':
                include"views/home.php";
                break;
            case'mobile':
                include"views/mobile.php";
                break;
            case'signin':
                include"views/signin.php";
                break;
            case'register':
                include"views/register.php";
                break;
            case'phu-kien':
                include"views/phu-kien.php";
                break;
            case'logout':
                unset($_SESSION['member']);
                echo"<script>location='?option=home';</script>"; 
                break;
            case'history':
                include"views/history.php";
                break;
            case'forgot':
                include"views/forgot.php";
                break;
            case'productdetail':
                include"views/productdetail.php";
                break;
            case'showproducts':
                include"views/showproducts.php";
                break;
            case'cart':
                include"views/cart.php";
                break;
            case'order':
                include"views/order.php";
                break;
            case'ordersuccess':
                include"views/ordersuccess.php";
                break;
            case'tin-moi':
                include"views/news.php";
                break;
            case'tuyen-dung':
                include"views/noti.php";
                break;
            case'chinh-sach':
                include"views/policy.php";
                break;
            case'lien-he':
                include"views/contract.php";
                break;
            case'dang-xay-dung':
                include"views/demo.php";
                break;
        }
    }
    else{
        include"views/home.php";
    }  
?>
<!-- end home -->
<section class="myfooter bg-dark text-white py-4">
    <?php include"views/layout/footer.php"; ?>
</section>
<!-- end footer -->
<script src="assets/vendors/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="assets/owlcarousel/owl.carousel.js"></script>
<script>
           $(document).ready(function() {
              var owl = $('.owl-carousel');
              owl.owlCarousel({
                dots:false,
                autoplay: true,
                autoplayTimeout: 10000,
                autoplayHoverPause: true,
                autoplaySpeed: 1000,
                margin: 10,
                nav: true,
                loop: true,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 2
                  },
                  1000: {
                    items: 4
                  }
                }
              })
            })

            $('.filter').owlCarousel({
                dots:false,
                autoplay: true,
                autoplayTimeout: 10000,
                autoplayHoverPause: true,
                autoplaySpeed: 1000,
                margin: 10,
                nav: true,
                loop: true,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 2
                  },
                  1000: {
                    items: 2
                  }
                }
              })
            
</script>
</body>
</html>