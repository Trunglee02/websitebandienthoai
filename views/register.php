<?php
if(isset($_POST['username'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $mobile=$_POST['mobile'];
  $email=$_POST['email']; 
  $address=$_POST['address'];
  $query="select*from member where username='$username'";
  $result=$connect->query($query);
  if(mysqli_num_rows($result)!=0){
      $alert="Tên đăng nhập đã được sử dụng!";
  
  }else{
      $query="insert member(
      username, password, mobile, email,address) values ('$username','$password', '$mobile', '$email', '$address')";
      $connect->query($query);
      echo "<script>alert('Bạn đã đăng ký thành công!'); location='?option=signin';</script>";
  }
}
?>
<section class="min-vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="images/img-signin.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="post" onsubmit="if(repassword.value!=password.value){alert('Xác nhận mật khẩu không chính xác!');return false;}">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-4 me-3 fw-bold fs-4 mt-5">Đăng ký tài khoản</p>
          </div>
          <section style="color:red"><?=isset($alert)?$alert:"";?></section>
          <div data-mdb-input-init class="form-outline mb-2">
            <label class="form-label fw-bold" for="form3Example3">Tài khoản</label>
            <input type="text" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nhập tên tài khoản" name="username" required>           
          </div>
          <div data-mdb-input-init class="form-outline mb-2">
            <label class="form-label fw-bold" for="form3Example3">Số điện thoại</label>
            <input type="tel" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nhập số điện thoại" name="mobile" required pattern="(0|\+84)\d{9}">            
          </div>
          <div data-mdb-input-init class="form-outline mb-2">
            <label class="form-label fw-bold" for="form3Example3">Email</label>
            <input type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nhập email" name="email">            
          </div> 
          <div data-mdb-input-init class="form-outline mb-2">
            <label class="form-label fw-bold" for="form3Example3">Địa chỉ</label>
            <textarea class="form-control" id="address" name="address" rows="2"></textarea>
          </div>        
          <div data-mdb-input-init class="form-outline mb-2">
            <label class="form-label fw-bold" for="form3Example4">Mật khẩu</label>
            <input type="password" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nhập mật khẩu" name="password" required>
          </div>
          <div data-mdb-input-init class="form-outline mb-2">
            <label class="form-label fw-bold" for="form3Example4">Nhập lại mật khẩu</label>
            <input type="password" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nhập lại mật khẩu" name="repassword" required>
          </div>
          <div class="text-center text-lg-start mt-4 pt-2 mb-3">
          <input type="submit" class="btn btn-danger btn-lg w-100" style="margin:0" value="Đăng ký">
            <p class="small fw-bold mt-2 pt-1 mb-2">Bạn đã có tài khoản? <a href="?option=signin"
                class="link-danger text-decoration-none">Đăng nhập</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>