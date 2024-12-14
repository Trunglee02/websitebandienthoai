<?php 
$product = mysqli_fetch_array($connect->query("select * from products where id=" . $_GET['id'])); 
?>
<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $query = "select * from products where name='$name' and id!=" . $product['id'];
    if (mysqli_num_rows($connect->query($query)) != 0) {
        $alert = "Tên sản phẩm đã tồn tại!";
    } else {
        $brandid = $_POST['brandid'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $description = $_POST['description'];
        $description_short = $_POST['description_short'];
        $status = $_POST['status'];
        $price_original= $_POST['price_original'];
        // Kiểm tra điều kiện giá sản phẩm
        if ($price != 0 && $price <= $discount) {
            $alert = "Giá sản phẩm phải lớn hơn giá bán hoặc bằng 0.";
        } else {
            // Xử lý ảnh
            $store = "../images/";
            $imageName = $_FILES['image']['name'];
            $imageTemp = $_FILES['image']['tmp_name'];
            $exp3 = substr($imageName, strlen($imageName) - 3); // aocd.jpg, ABCD1234.JPG
            $exp4 = substr($imageName, strlen($imageName) - 4); // jpeg, webp
            if ($exp3 == 'jpg' || $exp3 == 'png' || $exp3 == 'bmp' || $exp3 == 'gif' || $exp3 == 'JPG' || $exp3 == 'PNG' || $exp3 == 'BMP' || $exp3 == 'GIF' || $exp4 == 'jpeg' || $exp4 == 'JPEG' || $exp4 == 'webp' || $exp4 == 'WEBP') {
                $imageName = time() . '_' . $imageName;
                move_uploaded_file($imageTemp, $store . $imageName);
                if (!empty($product['image'])) {
                    unlink($store . $product['image']);
                }
            } else {
                $alert = "Định dạng file không hợp lệ. Vui lòng chọn file ảnh.";
            }
            if (empty($imageName)) {
                $imageName = $product['image'];
            }

            $connect->query("update products set brandid='$brandid', name='$name', price='$price', discount='$discount', price_original='$price_original', image='$imageName', description='$description', description_short='$description_short', status='$status' where id=" . $product['id']);

            // Xóa các ảnh con cũ của sản phẩm nếu có ảnh mới được tải lên
            if (!empty(array_filter($_FILES['imageproduct']['name']))) {
                $subImages = $connect->query("select * from imageproduct where productid=" . $product['id']);
                while ($subImage = mysqli_fetch_array($subImages)) {
                    unlink($store . $subImage['path']);
                }
                $connect->query("delete from imageproduct where productid=" . $product['id']);

                // Xử lý các ảnh con
                foreach ($_FILES['imageproduct']['name'] as $key => $value) {
                    $subImageName = time() . '_' . $value;
                    $subImageTemp = $_FILES['imageproduct']['tmp_name'][$key];
                    move_uploaded_file($subImageTemp, $store . $subImageName);
                    $connect->query("insert into imageproduct(productid, path) values('" . $product['id'] . "', '$subImageName')");
                }
            }

            echo "<script>location='?option=product';</script>";
        }
    }
}
?>
<?php
$brands = $connect->query("select * from brands");
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=product"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a> Sửa sản phẩm</h1>
</div>
<section style="color: red; text-align:center"><?= isset($alert) ? $alert : '' ?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Hãng: </label>
            <select name="brandid" class="form-control">
                <option hidden>--Chọn hãng--</option>
                <?php foreach ($brands as $item): ?>
                    <option value="<?= $item['id'] ?>" <?= $item['id'] == $product['brandid'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </section>
        <section class="form-group">
            <label>Tên:</label><input name="name" class="form-control" required value="<?= $product['name'] ?>">
        </section>
        <section class="form-group">
            <label>Giá nhập:</label><input type="number" min="100000" name="price_original" class="form-control" required value="<?= $product['price_original'] ?>">
        </section>
        <section class="form-group">
            <label>Giá khuyến mãi( nếu có):</label>
            <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>">
        </section>
        <section class="form-group">
            <label>Giá bán:</label><input type="number" min="100000" name="discount" class="form-control" required value="<?= $product['discount'] ?>">
        </section>
        <section class="form-group">
            <label>Ảnh:</label><br>
            <img src="../images/<?= $product['image'] ?>" alt="Product Image">
            <input type="file" name="image" class="form-control">
        </section>
        <section class="form-group">
            <label>Các ảnh chi tiết:</label>
            <?php 
            $subImages = $connect->query("select * from imageproduct where productid=" . $product['id']); 
            foreach ($subImages as $subImage): 
            ?> 
            <img src="../images/<?= $subImage['path'] ?>" alt="Sub Image" style="max-width: 100px; margin: 5px;"> 
            <?php endforeach; ?> 
            <input type="file" name="imageproduct[]" multiple class="form-control"> 
        </section>
        <section class="form-group">
            <label>Mô tả sản phẩm:</label>
            <textarea name="description" id="description"><?= $product['description'] ?></textarea>
            <script>CKEDITOR.replace('description');</script>
        </section>
        <section class="form-group">
            <label>Mô tả khuyến mãi:</label>        
            <textarea name="description_short" id="description_short"><?= $product['description_short'] ?></textarea>
            <script>CKEDITOR.replace('description_short');</script>
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br>
            <input type="radio" name="status" value="1" <?= $product['status'] == 1 ? 'checked' : '' ?>> Hoạt động 
            <input type="radio" name="status" value="0" <?= $product['status'] == 0 ? 'checked' : '' ?>> Khóa
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-success">
        </section>
    </form>   
</section>
