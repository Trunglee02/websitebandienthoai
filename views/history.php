<?php
if (isset($_SESSION['member']) && isset($_SESSION['member']['username'])) {
    // Lấy thông tin từ mảng $_SESSION['member']
    $tendangnhap = $_SESSION['member']['username'];
}
?>

<div class="container history">
    <div class="sidebar">
        <div class="icon-history" style="display:flex; align-items: center; margin-bottom: 20px; color: black; font-size: 20px; font-weight: bold;">
            <i class="fas fa-user-circle" style="color: gray; font-size: 45px; margin-right: 10px;"></i> <?php echo $tendangnhap; ?>
        </div>
        <a href="?option=history&infor=1" onclick="setActive(this)" class="menu-link"><i class="fas fa-shipping-fast"></i> Đơn hàng</a>
        <a href="?option=history&infor=2" onclick="setActive(this)" class="menu-link"><i class="far fa-address-card"></i> Tài khoản</a>
        <a href="?option=logout" class="menu-link"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>
    <div class="main-content">
        <?php
        if (isset($_GET['option']) && isset($_GET['infor'])) {
            switch ($_GET['infor']) {
                case '1':
                    if (isset($_GET['orderid'])) {
                        include "views/infor_orderdetail.php";
                    } else {
                        include "views/infor_order.php";
                    }
                    break;
                case '2':
                    include "views/infor_user.php";
                    break;
            }
        } else {
            include "views/infor_order.php";
        }
        ?>
    </div>
</div>
<style>
    .history {
        display: flex;
    }
    .sidebar {
        width: 250px;
        height: 100vh;
        background-color: #f8f9fa;
        padding-top: 20px;
        flex-shrink: 0;
    }
    .sidebar h2, .sidebar p {
        text-align: center;
    }
    .sidebar a.active,
    .sidebar a.default-active {
        background-color: #fef2f2; /* Màu nền khi mục menu được chọn */
        color: red; /* Màu chữ khi di chuột */
    }
    .sidebar a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
        cursor: pointer;
    }
    .sidebar a:hover {
        background-color: #ddd;
    }
    .main-content {
        flex-grow: 1;
        padding: 20px;
    }
</style>

<script>
    // Hàm thay đổi lớp 'active' trên thanh menu
    function setActive(element) {
        // Lấy tất cả các mục menu
        var links = document.querySelectorAll('.sidebar a.menu-link');
        // Xóa lớp 'active' khỏi tất cả các mục menu
        links.forEach(function(link) {
            link.classList.remove('active');
        });
        // Thêm lớp 'active' vào mục được chọn
        element.classList.add('active');
        // Lưu trạng thái 'active' vào localStorage
        localStorage.setItem('activeMenuLink', element.href);
    }

    // Đặt mặc định mục đầu tiên là 'active' khi tải trang
    document.addEventListener('DOMContentLoaded', function() {
        var links = document.querySelectorAll('.sidebar a.menu-link');
        var currentURL = window.location.href; // Lấy toàn bộ URL hiện tại
        var activeMenuLink = localStorage.getItem('activeMenuLink'); // Lấy trạng thái 'active' từ localStorage

        if (activeMenuLink) {
            // Kiểm tra nếu có trạng thái 'active' trong localStorage và áp dụng nó
            links.forEach(function(link) {
                if (link.href === activeMenuLink) {
                    link.classList.add('active');
                }
            });
        } else {
            // Nếu không có trạng thái 'active' trong localStorage, đặt mặc định mục đầu tiên là 'active'
            links[0].classList.add('default-active');
        }
    });
</script>
