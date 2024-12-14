<?php
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $content = $_POST['content'];
    $query="INSERT INTO comment (email, date, content) VALUES ('$email', now(), '$content')";
    $connect->query($query);
    echo"<script>location='?option=lien-he';</script>";
}
?>
<style>
    .contact {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .contact-info, .contact-form {
        width: 100%;
        max-width: 600px;
        margin-bottom: 20px;
    }
    .contact-info h4{
        margin-bottom: 20px;
        margin-left: 23px;
    }
    .contact-info li {
        margin: 8px 0;
        list-style-type: none;
    }
    .contact-info li a{
        text-decoration: none;
        color: black;
    }
    .contact-info li a i { 
        color: gray; 
        margin-right: 5px;
    }
</style>

<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?option=home" style="text-decoration: none; color: black"><i class="fas fa-home" style="color: gray;"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
        </ol>
    </nav>
    <div class="contact">
        <div class="contact-info mt-3">
            <h4>THÔNG TIN LIÊN HỆ</h4>
            <ul class="list-menu">
                <li class="li_menu"><a class="info"><i class="fa-solid fa-phone-volume"></i> Hotline: 0889502728</a></li>
                <li class="li_menu"><a class="info"><i class="fa-regular fa-envelope"></i> Email: tvietese@gmail.com</a></li>
                <li class="li_menu"><a class="info"><i class="fa-regular fa-clock"></i> Giờ làm việc: 08h30 - 22h00<br>(Tất cả các ngày trong tuần)</a></li>
                <li class="li_menu"><a class="info"><i class="fa-solid fa-location-dot"></i> Cơ sở: Số 18 Phố Viên, Đông Ngạc, Bắc Từ Liêm, Hà Nội</a></li>                   
            </ul>
        </div>

        <div class="contact-form p-3 border rounded">
            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung cần hỗ trợ *</label>
                    <textarea class="form-control" id="content" name="content" rows="5" placeholder="Nhập nội dung"></textarea>
                </div>
                <button type="submit" class="btn btn-danger w-100">Gửi thông tin</button>
            </form>
        </div>
    </div>
</div>
