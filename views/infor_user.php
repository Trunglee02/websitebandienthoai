<?php
if (isset($_SESSION['member']) && isset($_SESSION['member']['username'])) {
    // Lấy thông tin từ mảng $_SESSION['member']
    $tendangnhap = $_SESSION['member']['username'];

    // Lấy thông tin email và số điện thoại từ cơ sở dữ liệu
    $sql = "SELECT email, mobile, address FROM member WHERE username = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $tendangnhap);
    $stmt->execute();
    $stmt->bind_result($email, $mobile, $address);
    $stmt->fetch();
    $stmt->close();
}

$loi = "";
$thanhcong = "";
if (isset($_POST['btndoimatkhau'])) {
    $matkhaucu = $_POST['matkhaucu'];
    $matkhaumoi_1 = $_POST['matkhaumoi_1'];
    $matkhaumoi_2 = $_POST['matkhaumoi_2'];
    $username = $_POST['tendangnhap'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    // Kiểm tra mật khẩu cũ
    $sql = "SELECT * FROM member WHERE username = ? AND password = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ss", $tendangnhap, $matkhaucu);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        $loi .= "Mật khẩu cũ không đúng<br>";
    }
    if (strlen($matkhaumoi_1) < 6) {
        $loi .= "Mật khẩu mới quá ngắn<br>";
    }
    if ($matkhaumoi_1 != $matkhaumoi_2) {
        $loi .= "Mật khẩu mới không trùng khớp<br>";
    }
    if ($loi == "") {
        $sql = "UPDATE member SET password = ?, username = ?, mobile = ?, email = ?, address = ? WHERE username = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ssssss", $matkhaumoi_1, $username, $mobile, $email, $address, $tendangnhap);
        $stmt->execute();
        
        // Cập nhật lại session với thông tin mới
        $_SESSION['member']['username'] = $username;
        $tendangnhap = $username;

        $thanhcong = "Đã cập nhật thông tin mới";
    }
    $stmt->close();
}
?>

<div class="container infor-user" style="max-width: 500px !important">
    <?php if ($loi != "") { ?>
        <div class="alert alert-danger" role="alert"><?php echo $loi ?></div>
    <?php } elseif ($thanhcong != "") { ?>
        <div class="alert alert-success" role="alert"><?php echo $thanhcong ?></div>
    <?php } ?>
    <h3 class="mb-3">Thay đổi thông tin</h3>
    <form method="post">
        <div class="mb-3">
            <label for="tendangnhap" class="form-label">Tên đăng nhập</label>
            <input value="<?php echo $tendangnhap ?>" type="text" class="form-control" id="tendangnhap" name="tendangnhap">
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label">Số điện thoại</label>
            <input value="<?php echo $mobile; ?>" type="text" class="form-control" id="mobile" name="mobile">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="<?php echo $email; ?>" type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input value="<?php echo $address; ?>" type="text" class="form-control" id="address" name="address">
        </div>
        <div class="mb-3">
            <label for="matkhaucu" class="form-label">Mật khẩu cũ</label>
            <input value="<?php if (isset($matkhaucu)) echo $matkhaucu; ?>" type="password" class="form-control" id="matkhaucu" name="matkhaucu">
        </div>
        <div class="mb-3">
            <label for="matkhaumoi_1" class="form-label">Mật khẩu mới</label>
            <input value="<?php if (isset($matkhaumoi_1)) echo $matkhaumoi_1; ?>" type="password" class="form-control" id="matkhaumoi_1" name="matkhaumoi_1">
        </div>
        <div class="mb-3">
            <label for="matkhaumoi_2" class="form-label">Nhập lại mật khẩu</label>
            <input value="<?php if (isset($matkhaumoi_2)) echo $matkhaumoi_2; ?>" type="password" class="form-control" id="matkhaumoi_2" name="matkhaumoi_2">
        </div>
        <button type="submit" name="btndoimatkhau" class="btn btn-danger">Xác nhận</button>
    </form>
</div>
