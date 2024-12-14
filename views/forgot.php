<?php
$erro="";
if (isset($_POST['guimail'])==true){
    $email = $_POST['email'];
    $query = "select * from member where email='$email'";
    $result = $connect->query($query);
    if (mysqli_num_rows($result) == 0) {
        $erro = "Tên email chưa được đăng ký";
    } else {
        $matkhaumoi = substr( md5( rand(0,999999)) , 0, 8);
        $query = "update member set password='$matkhaumoi' where email='$email'";
        $result = $connect->query($query);
        // PHPMailer-master
        require "PHPMailer-master/src/PHPMailer.php"; 
        require "PHPMailer-master/src/SMTP.php"; 
        require 'PHPMailer-master/src/Exception.php'; 
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
        try {
            $mail->SMTPDebug = 0; //0,1,2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = 'levantrung19842@gmail.com'; // SMTP username
            $mail->Password = 'gqllqkyawcbkdefx';   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom('levantrung19842@gmail.com', 'Trung Mobile'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = '[TrungMobile] Thông báo gửi lại mật khẩu';
            $noidungthu = "<p>Bạn nhận được email này vì bạn hoặc ai đó vừa sử dụng chức năng quên mật khẩu tại website TrungMobile</p>
                Mật khẩu mới của bạn là {$matkhaumoi}
            "; 
            $mail->Body = $noidungthu;
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
            echo "<script>alert('Hảy kiểm tra email của bạn!'); location='?option=signin';</script>";
        } catch (Exception $e) {
            echo 'Error: lỗi', $mail->ErrorInfo;
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
            <p class="lead fw-normal mb-4 me-3 fw-bold fs-4">Quên mật khẩu</p>
          </div>
          <?php if ($erro !="") { ?>
            <div class="alert alert-danger"><?= $erro?> </div>
            <?php } ?>
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label fw-bold" for="form3Example3">Email</label>
            <input value="<?php if (isset($email)==true) echo $email ?>" type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nhập địa chỉ email" name="email" required>            
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
          <input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem; width: 100%; background: #e0052b; border: none; margin-bottom: 10px" name="guimail" value="Gửi">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>