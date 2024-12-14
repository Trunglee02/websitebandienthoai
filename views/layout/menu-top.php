<?php
    $query_brands="select*from brands where status";
    $result_brands=$connect->query($query_brands);

    $query_prices="select*from prices where status";
    $result_prices=$connect->query($query_prices);
?>
<div class="container">
        <nav class="navbar navbar-expand-lg">                                            
            <div class="row collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="col nav-item">
                        <a class="nav-link text-white" href="?option=home"><i class="fa-solid fa-house icon-large"></i> TRANG CHỦ</a>
                    </li> 
                    <li class="col nav-item dropdown">
                        <a class="nav-link text-white" href="?option=mobile">
                        <i class="fa-solid fa-mobile-screen-button icon-large"></i> ĐIỆN THOẠI
                        </a>
                        <div class="dropdown-menu">
                        <div class="dropdown-content">
                            <div class="hang-dien-thoai">                             
                            <a class="dropdown-item" href="#">HÃNG ĐIỆN THOẠI</a>
                            <ul class="dropdown-menu">
                                <?php foreach($result_brands as $item):?>
                                <li>
                                    <a href="?option=showproducts&brandid=<?=$item['id']?>"><?=$item['name']?></a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            </div>
                            <div class="muc-gia">
                            <a class="dropdown-item" href="#">MỨC GIÁ</a>
                            <ul class="dropdown-menu">
                            <?php foreach($result_prices as $item):?>
                                <li><a href="?option=showproducts&fromprice=<?=$item['fromPrice']?>&toprice=<?=$item['toPrice']?>"><?=$item['pricename']?></a></li>
                            <?php endforeach;?>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </li>       
                    <li class="col nav-item">
                        <a class="nav-link text-white" href="?option=tin-moi"><i class="fa-regular fa-newspaper icon-large"></i> TIN MỚI</a>
                    </li>
                    <li class="col nav-item">
                        <a class="nav-link text-white" href="?option=tuyen-dung"><i class="fa-regular fa-bell icon-large"></i> TUYỂN DỤNG</a>
                    </li>
                    <li class="col nav-item">
                        <a class="nav-link text-white" href="?option=chinh-sach"><i class="fa-solid fa-toolbox icon-large"></i> CHÍNH SÁCH</a>
                    </li>
                    <li class="col nav-item">
                        <a class="nav-link text-white" href="?option=lien-he"><i class="fas fa-tools"></i></i> LIÊN HỆ</a>
                    </li>
                </ul>
            </div>                   
        </nav>               
    </div>
