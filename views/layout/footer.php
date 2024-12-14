<?php
// Retrieve the current settings
$settings_result = $connect->query("SELECT * FROM setting WHERE id = 1");
$settings = $settings_result->fetch_assoc();
?>

<div class="container">
        <div class="row">
            <div class="col-md-3">
                <div>
                    <h4 class="fs-5">ĐỊA CHỈ LIÊN HỆ</h4>
                    <ul class="list-menu">
                        <li class="li_menu"><a class="info"><i class="fa-solid fa-location-dot"></i> Cơ sở: <?= $settings['address'] ?></a></li>                   
                    </ul>
                </div>
                <div style="margin-top: 10px;">
                    <h4 class="fs-6">KẾT NỐI VỚI <?= $settings['namestore'] ?></h4>
                    <a href="https://www.facebook.com/trunglee008"><img src="images/facebook_icon.svg" style="border-radius: 50%; margin: 5px;" alt="Facebook"></a>
                    <a href="https://zalo.me/0969674755"><img src="images/zalo_icon.svg" style="border-radius: 50%; margin: 5px;" alt="Zalo"></a>
                    <a><img src="images/youtube_icon.svg" style="border-radius: 50%; margin: 5px;" alt="YouTube"></a>
                    <a><img src="images/tiktok_icon.svg" style="border-radius: 50%; margin: 5px;" alt="TikTok"></a>
                </div>               
            </div>
            <div class="col-md-3">
                <h4 class="fs-5">THÔNG TIN LIÊN HỆ</h4>
                <ul class="list-menu">
                    <li class="li_menu"><a class="info"><i class="fa-solid fa-phone-volume"></i> Hotline: <?= $settings['mobile'] ?></a></li>
                    <li class="li_menu"><a class="info"><i class="fa-regular fa-envelope"></i> Email: <?= $settings['email'] ?></a></li>
                    <li class="li_menu"><a class="info"><i class="fa-regular fa-clock"></i> Giờ làm việc: <?= $settings['timetext'] ?><br>(Tất cả các ngày trong tuần)</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4 class="fs-5">VỀ CHÚNG TÔI</h4>
                <ul class="list-menu">
                    <li class="li_menu"><a href="?option=lien-he" title="Giới thiệu">Liên hệ</a></li>
                    <li class="li_menu"><a href="?option=mobile" title="Sản phẩm">Sản phẩm</a></li>
                    <li class="li menu"><a href="?option=tin-moi" title="Tin mới nhất" >Tin mới nhất</a></li>
                    <li class="li_menu"><a href="?option=chinh-sach" title="Câu hỏi thường gặp">Câu hỏi thường gặp</a></li>
                    <li class="li_menu"><a href="?option=tuyen-dung" title="Tuyển dụng"> Tuyển dụng</a></li>
                    <li class="li menu"><a href="?option=home" title="Mua hàng">Trang chủ</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4 class="fs-5">CHÍNH SÁCH</h4>
                <ul class="list-menu">
                    <li class="li_menu"><a href="?option=chinh-sach" title="Chính sách bảo hành">Chính sách bảo hành</a></li>
                    <li class="li_menu"><a href="?option=chinh-sach" title="Chính sách đổi trả">Chính sách đổi trả</a></li>
                    <li class="li_menu"><a href="?option=chinh-sach" title="Chính sách bảo mật">Chính sách bảo mật</a></li>
                    <li class="li menu"><a href="?option=chinh-sach" title="Chính sách trả góp">Chính sách trả góp</a></li>
                    <li class="li_menu"><a href="?option=chinh-sach" title="Chính Sách Kiểm Hàng">Chính Sách Kiểm Hàng</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" style="color: gray;">
                Made with by © levantrung, 2024
                </div>
            </div>
        </div>
    </div>