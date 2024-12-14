<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="../images/img-signin.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="post">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-4 me-3 fw-bold fs-4">Đăng nhập admin</p>
            </div>
          <section><?= isset($alert) ? $alert : "" ?></section>
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
          <div class="text-center text-lg-start mt-4 pt-2">
          <input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem; width: 100%; background: #e0052b; border: none; margin-bottom: 10px" value="Đăng nhập">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>