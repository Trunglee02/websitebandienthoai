<?php
// Retrieve the current settings
$settings_result = $connect->query("SELECT * FROM setting WHERE id = 1");
$settings = $settings_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namestore = $_POST['namestore'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $timetext = $_POST['timetext'];

    // Process logo image if a new one is uploaded
    $logo_updated = false;
    if (!empty($_FILES['logo']['name'])) {
        $store = "../images/";
        $imageName = $_FILES['logo']['name'];
        $imageTemp = $_FILES['logo']['tmp_name'];
        $exp3 = substr($imageName, strlen($imageName) - 3);
        $exp4 = substr($imageName, strlen($imageName) - 4);

        if ($exp3 == 'jpg' || $exp3 == 'png' || $exp3 == 'bmp' || $exp3 == 'gif' || $exp3 == 'JPG' ||
            $exp3 == 'PNG' || $exp3 == 'BMP' || $exp3 == 'GIF' || $exp4 == 'jpeg' || $exp4 == 'JPEG' ||
            $exp4 == 'webp' || $exp4 == 'WEBP') {
            
            $imageName = time() . '_' . $imageName;
            move_uploaded_file($imageTemp, $store . $imageName);
            $logo_updated = true;
        } else {
            echo "<script>alert('Chỉ cho phép các định dạng ảnh: JPG, PNG, BMP, GIF, JPEG, WEBP');</script>";
            exit();
        }
    }

    // Update the setting table
    if ($logo_updated) {
        $connect->query("UPDATE setting SET logo='$imageName', namestore='$namestore', address='$address', 
                         mobile='$mobile', email='$email', timetext='$timetext' WHERE id=1");
    } else {
        $connect->query("UPDATE setting SET namestore='$namestore', address='$address', 
                         mobile='$mobile', email='$email', timetext='$timetext' WHERE id=1");
    }

    echo "<script>alert('Thông tin cửa hàng đã được cập nhật thành công!');</script>";
    echo "<script>location='?option=setting';</script>";
}
?>
<h3 class="mt-4">Thông tin cửa hàng</h3>
<div class="container col-md-6 mt-5">
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="logo" class="form-label">Logo cửa hàng</label>
            <input type="file" name="logo" class="form-control" id="logo">
            <?php if(isset($settings['logo'])): ?>
                <img src="../images/<?= $settings['logo'] ?>" alt="Logo" width="100">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="namestore" class="form-label">Tên cửa hàng</label>
            <input type="text" name="namestore" class="form-control" id="namestore" value="<?= $settings['namestore'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ cửa hàng</label>
            <textarea class="form-control" id="address" name="address" rows="5" required><?= $settings['address'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label">Số Điện Thoại</label>
            <input type="text" name="mobile" class="form-control" id="mobile" value="<?= $settings['mobile'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= $settings['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="timetext" class="form-label">Giờ làm việc</label>
            <input type="text" name="timetext" class="form-control" id="timetext" value="<?= $settings['timetext'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
