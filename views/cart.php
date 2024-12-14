<?php
if(empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
if(isset($_GET['action'])){
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    switch($_GET['action']) {
        case 'add':
            $id = $_GET['id'];
            $query = "SELECT quantity FROM products WHERE id = $id";
            $result = $connect->query($query);
            $product = $result->fetch_assoc();
            // check số lượng sản phẩm
            if (array_key_exists($id, $_SESSION['cart'])) {
                if ($_SESSION['cart'][$id] < $product['quantity']) {
                    $_SESSION['cart'][$id]++;
                } else {
                    echo "<script>alert('Sản phẩm này đã hết hàng!');</script>";
                }
            } else {
                if ($product['quantity'] > 0) {
                    $_SESSION['cart'][$id] = 1;
                } else {
                    echo "<script>alert('Sản phẩm này đã hết hàng!');</script>";
                }
            }
            echo "<script>location='?option=cart';</script>"; 
            break;
        case 'delete':
            unset($_SESSION['cart'][$id]);
            $_SESSION['total_items'] = 0;
            echo "<script>location='?option=cart';</script>";
            break;
        case 'deleteall':
            unset($_SESSION['cart']);
            $_SESSION['total_items'] = 0;
            echo "<script>location='?option=cart';</script>";
            break;
        case 'update':
            $query = "SELECT quantity FROM products WHERE id = $id";
            $result = $connect->query($query);
            $product = $result->fetch_assoc();

            if($_GET['type'] == 'asc') {
                if ($_SESSION['cart'][$id] < $product['quantity']) {
                    $_SESSION['cart'][$id]++;
                } else {
                    echo "<script>alert('Sản phẩm này đã hết hàng!');</script>";
                }
            } else {
                if($_SESSION['cart'][$id] > 1) {
                    $_SESSION['cart'][$id]--;
                }
            }
            echo "<script>location='?option=cart';</script>"; 
            break;
        case 'order':
            if(isset($_SESSION['member'])){
                echo "<script>location='?option=order';</script>"; 
            } else {
                echo "<script>location='?option=signin&order=1';</script>"; 
            }
            break;
    }
}
?>
<div class="container">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="?option=home" style="text-decoration: none; color: black"><i class="fas fa-home" style="color: gray;"></i> Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
    </ol>
</nav>
<section class="cart">
<?php
if(!empty($_SESSION['cart'])):
    $ids = implode(',', array_keys($_SESSION['cart']));
    $query = "SELECT * FROM products WHERE id IN ($ids)";
    $result = $connect->query($query);
?>
    <table class="table">
        <thead>
            <tr>
                <td>Sản phẩm</td>
                <td>Giá</td>
                <td>Số lượng</td>
                <td>Thành tiền</td>
                <td><section><input type="button" class="text-decoration-underline" style="background-color: transparent; border: 0;color: #9f9d9d;" 
                value="Xóa tất cả" onclick="if(confirm('Bạn có chắc chắn không!')) location='?option=cart&action=deleteall';"></td>
            </tr>
        </thead>
        <tbody>
<?php
    $totalItem = 0;
    $toTal = 0;
    foreach($result as $item):  
?>
        <tr>
            <td class="align-middle" width="40%"><img width="20%" src="images/<?=$item['image']?>"><?=$item['name']?></td>
            <td class="align-middle"><?=number_format($item['discount'],0,',','.')?></td>
            <td class="align-middle"><?=$_SESSION['cart'][$item['id']]?>
            <input type="button" value="+" onclick="location='?option=cart&action=update&type=asc&id=<?=$item['id']?>';">
            <input type="button" value="-" onclick="location='?option=cart&action=update&type=desc&id=<?=$item['id']?>';">
            </td>
            <td class="align-middle"><?=number_format($subTotal=$item['discount']*$_SESSION['cart'][$item['id']],0,',','.')?></td>
            <td class="align-middle"><i class="far fa-trash-alt" style="font-size:20px;color: #9f9d9d;" onclick=
            "location='?option=cart&action=delete&id=<?=$item['id']?>';" ></i></td>
        </tr>
        </tr>
        <?php $toTal+=$subTotal;?>
        <?php 
        $totalItem+=$_SESSION['cart'][$item['id']];      
        ?>
<?php
    endforeach;
?>   
    <tr>
        <td colspan="5">
        <div class="d-flex justify-content-end mt-3"> 
            <div class="text-start"> 
                <div>Tổng tiền: <span class="text-danger"><?=number_format($toTal,0,',','.')?> đ</span></div> 
                <input type="button" value="Mua hàng" class="btn btn-danger mt-2" onclick="location='?option=cart&action=order';"> 
            </div> 
        </div>
        </td>
    </tr>
    </tbody>
    </table>
<?php
    $_SESSION['total_items'] = $totalItem;
?>
<?php
else:
?>
    <section style="text-align:center; color:red; font-weight: bold; font-size: 25px; margin: 20px 0 500px">Giỏ hàng trống</section>
<?php
endif;
?>
</section>
</div>
