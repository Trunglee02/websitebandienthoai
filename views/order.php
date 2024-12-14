<?php
    if (isset($_SESSION['member']) && isset($_SESSION['member']['username'])) {
        // Lấy thông tin từ mảng $_SESSION['member']
        $username = $_SESSION['member']['username'];
        $query = "SELECT * FROM member WHERE username = '$username'";
        $member = mysqli_fetch_array($connect->query($query));
    }
?>
<?php
    if(isset($_POST['name'])){
        $name=$_POST['name'];
        $mobile=$_POST['mobile'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $note=$_POST['note'];
        $ordermethodid=$_POST['ordermethodid'];
        $memberid=$member['id'];
        $query="INSERT INTO orders(ordermethodid, memberid, name, address, mobile, email, note) VALUES($ordermethodid, $memberid, '$name', '$address', '$mobile', '$email', '$note')";
        $connect->query($query);
        $query="SELECT id FROM orders ORDER BY id DESC LIMIT 1";
        $orderid=mysqli_fetch_array($connect->query($query))['id'];
        foreach($_SESSION['cart'] as $key=>$value) {
            $productid=$key;
            $number=$value;
            $query="SELECT discount, price_original FROM products WHERE id=$key";
            $result=mysqli_fetch_array($connect->query($query));
            $discount=$result['discount'];
            $price_original=$result['price_original'];
            $query="INSERT INTO orderdetail(productid, orderid, number, price, price_original) VALUES ($productid, $orderid, $number, $discount, $price_original)";
            $connect->query($query);
        }
        unset($_SESSION['cart']);
        unset($_SESSION['total_items']);
        echo"<script>location='?option=ordersuccess';</script>";
    }
?>
<div class="container mb-5">
<div class="d-flex align-items-center mt-4 ml-2"> 
    <a href="?option=cart" class="d-flex align-items-center text-decoration-none"> 
        <i class="fas fa-chevron-left" style="font-size: 20px; color:gray"></i> 
        <span class="ms-2 fw-bold text-dark fs-6">Quay lại</span> 
    </a> 
</div>
<form method="post" class="row">
<div class=" col-md-6">
<h3 class = "mt-5">THÔNG TIN NHẬN HÀNG</h3>
  <div class="col-md-6">
    <label for="inputName" class="form-label">Họ tên</label>
    <input type="text" name="name" class="form-control" id="inputName4" placeholder="Họ Tên" value="<?=$member['username']?>">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Địa chỉ</label>
    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
  </div>
  <div class="col-md-6">
    <label for="inputEmail" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="email" value="<?=$member['email']?>">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Số điện thoại</label>
    <input type="tel" name="mobile" class="form-control" id="inputCity" placeholder="Số điện thoại" value="<?=$member['mobile']?>">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Ghi chú</label>
    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
  </div>
  </section>
</div>
<div class="row col-md-6 mt-4" method="post" >
    <div>
        <div class="checkout-order mt-4" >
        <h2>Chọn phương thức thanh toán</h2>
    <?php
        $query="select*from ordermethod where status";
        $result=$connect->query($query);
    ?>
        <select name="ordermethodid">
            <?php foreach($result as $item):?>
                <option value="<?=$item['id']?>"><?=$item['name']?></option>
            <?php endforeach;?>
        </select>
    
        <section>
            <input type="submit" value="Thanh toán" style="margin:20px" class="btn btn-danger">
        </section>

                </div>
            </div>
        </div>
    </form>
</div>
