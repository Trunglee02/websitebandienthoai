<?php
    $chuaXuLy=mysqli_num_rows($connect->query("select*from orders where status=1"));
    $dangXuLy=mysqli_num_rows($connect->query("select*from orders where status=2"));
    $daXuLy=mysqli_num_rows($connect->query("select*from orders where status=3"));
    $daHuy=mysqli_num_rows($connect->query("select*from orders where status=4"));
?>
<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a href="?option=statistical" class="nav-link">
            <i class="fas fa-chart-bar"></i>
            <span>Thống kê</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Bảng điều khiển
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a href="?option=brand" class="nav-link collapsed">
            <i class="fas fa-mobile-alt"></i>
            <span>Thương hiệu</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a href="?option=product" class="nav-link collapsed">
            <i class="fas fa-database"></i>
            <span>Sản phẩm</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-shopping-cart"></i>
            <span>Đơn hàng</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item position-relative" href="?option=order&status=1">Đơn hàng chưa xử lý<span style="margin-left: -10px" class="position-absolute top-3 start-100 translate-middle badge rounded-pill bg-danger">
                <?=$chuaXuLy?>
                </span></a>
                <a class="collapse-item position-relative" href="?option=order&status=2">Đơn hàng đang xử lý<span style="margin-left: -10px" class="position-absolute top-3 start-100 translate-middle badge rounded-pill bg-danger">
                <?=$dangXuLy?>
                </span></a>   
                <a class="collapse-item position-relative" href="?option=order&status=3">Đơn hàng đã xử lý<span style="margin-left: -10px" class="position-absolute top-3 start-100 translate-middle badge rounded-pill bg-danger">
                <?=$daXuLy?>
                </span></a>
                <a class="collapse-item position-relative" href="?option=order&status=4">Đơn hàng đã hủy<span style="margin-left: -10px" class="position-absolute top-3 start-100 translate-middle badge rounded-pill bg-danger">
                <?=$daHuy?>
                </span></a>     
            </div>
        </div>
    </li>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="?option=user">
        <i class="fas fa-user"></i>
            <span>Người dùng</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?option=banner">
        <i class="fas fa-images"></i>
            <span>Banner</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?option=comment">
        <i class="fas fa-comments"></i>
            <span>Bình luận</span></a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="?option=setting">
        <i class="fas fa-cog"></i>
            <span>Cài đặt</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search (search màn hình máy tính) -->
            <!-- <form
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form> -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (search màn hình mobile) -->
                <!-- <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                   
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> -->
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Xin chào! <?=$_SESSION['admin']?></span>
                        <img class="img-profile rounded-circle"
                            src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a href="?option=logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
            <?php
            if(isset($_GET['option'])){
                switch($_GET['option']){
                    case'logout':
                        unset($_SESSION['admin']);
                        echo"<script>location=' .';</script>";
                        break;
                    case'brand':
                        include"brands/showbrands.php";
                        break;
                    case'brandadd':
                        include"brands/brandadd.php";
                        break;
                    case'brandupdate':
                        include"brands/brandupdate.php";
                        break;
                    case'brandsearch':
                        include"brands/searchbrand.php";
                        break;
                    case'product':
                        include"products/showproducts.php";
                        break;
                    case'productadd':
                        include"products/productadd.php";
                        break;
                    case'productupdate':
                        include"products/productupdate.php";
                        break;
                    case'productsearch':
                        include"products/searchproduct.php";
                        break;
                    case'order':
                        include"orders/showorders.php";
                        break;
                    case'orderdetail':
                        include"orders/orderdetail.php";
                        break;
                    case'ordersearch':
                        include"orders/searchorder.php";
                        break;
                    case'user':
                        include"users/showusers.php";
                        break;
                    case'userupdate':
                        include"users/userupdate.php";
                        break;
                    case'useradd':
                        include"users/useradd.php";
                        break;
                    case'usersearch':
                        include"users/searchuser.php";
                        break;
                    case'setting':
                        include"settings/setting.php";
                        break;
                    case'banner':
                        include"banners/banner.php";
                        break;
                    case'banneradd':
                        include"banners/banneradd.php";
                        break;
                    case'bannerupdate':
                        include"banners/bannerupdate.php";
                        break;
                    case'comment':
                        include"comments/comment.php";
                        break;
                    case'commentupdate':
                        include"comments/commentupdate.php";
                        break;
                    case'statistical':
                        include"statisticals/statistical.php";
                        break;
                }
            }else{
                include"statisticals/statistical.php";
            }
            ?>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Made with by © levantrung, 2024</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->