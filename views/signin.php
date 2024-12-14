<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // prepare() và bind_param() được sử dụng để tạo truy vấn có tham số, lỗi SQL Injection.
    $stmt = $connect->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $alert = "Sai tên đăng nhập hoặc mật khẩu";
    } else {
        $result = $result->fetch_assoc();
        
        if ($result['status'] == 0) {
            $alert = "Tài khoản đang bị khóa";
        } else {
            $last_name = explode(" ", $username)[count(explode(" ", $username)) - 1];
            $_SESSION['member'] = array(
                'username' => $username,
                'lastname' => $last_name
            );   
            if (isset($_GET['order'])) {
                echo "<script>location='?option=order';</script>"; 
            } elseif (isset($_GET['productid'])) {
                $productid = $_GET['productid'];
                echo "<script>location='?option=productdetail&id=$productid';</script>"; 
            } else {
                echo "<script>location='?option=home';</script>"; 
            }                 
        }
    }
}
?>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="images/img-signin.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="post">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-4 me-3 fw-bold fs-4">Đăng nhập tài khoản</p>
            <!-- <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>
            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-twitter"></i>
            </button>
            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-linkedin-in"></i>
            </button> -->
          </div>
          <section><?= isset($alert) ? $alert : "" ?></section>
          <!-- <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div> -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label fw-bold" for="form3Example3">Tài khoản</label>
            <input type="text" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nhập tên tài khoản" name="username" required>            
          </div>
          <div data-mdb-input-init class="form-outline mb-3">
            <label class="form-label fw-bold" for="form3Example4">Mật khẩu</label>
            <input type="password" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nhập mật khẩu" name="password" required>
          </div>
          <div class="d-flex justify-content-end align-items-center">
            <!-- Checkbox
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
              </label>
            </div> -->
            <a href="?option=forgot" class="text-body text-decoration-none">Quên mật khẩu?</a>
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
          <input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem; width: 100%; background: #e0052b; border: none; margin-bottom: 10px" value="Đăng nhập">
            <p class="small fw-bold mt-2 pt-1 mb-0">Bạn chưa có tài khoản? <a href="?option=register"
                class="link-danger text-decoration-none">Đăng ký</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>