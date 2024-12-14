<?php session_start();?>
<?php $connect = new MySQLi('localhost','root','','qly_web'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];   
    $query = "select*from admin where username='$username' and password='$password'";    
    $result = $connect->query($query);
    if (mysqli_num_rows($result) == 0) {
        $alert = "Sai tên đăng nhập hoặc mật khẩu";
    } else {
        $result = mysqli_fetch_array($result); 
        if ($result['status'] == 0) {
            $alert = "Tài khoản đang bị khóa";
        } else { 
          $_SESSION['admin']=$username; 
          
        }
    }
}
?>
<section>
    <?php
        if(isset($_SESSION['admin'])){
           include"admincontrolpanel.php";
        }else{
            include"login.php";
        }
    ?>
</section>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-bar-demo.js"></script>
</body>
</html>