<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Kiểm tra xem tên người dùng đã tồn tại chưa
    $query = "SELECT * FROM member WHERE username = '$username'";
    if (mysqli_num_rows($connect->query($query)) != 0) {
        $alert = "Tên người dùng đã tồn tại!";
    } else {
        $connect->query("insert member(username,password,mobile,email,status) values('$username','$password','$mobile','$email','$status')"); 
            echo"<script>location='?option=user';</script>";
    }
}
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=user"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a> Thêm người dùng</h1>
</div>
<div class="container col-md-6 mt-5">
    <section style="color: red; text-align:center"><?=isset($alert)?$alert:''?></section>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="username" class="form-label">Tên Đăng Nhập</label>
            <input type="text" name="username" class="form-control" id="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật Khẩu</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label">Số Điện Thoại</label>
            <input type="text" name="mobile" class="form-control" id="mobile" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" checked> 
            Hoạt động <input type="radio" name="status" value="0"> Khóa
        </div>
        <button type="submit" class="btn btn-primary">Xác nhận</button>
    </form>
</div>
