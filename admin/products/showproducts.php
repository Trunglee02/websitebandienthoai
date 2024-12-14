<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $products=$connect->query("select*from orderdetail where productid=$id");
        if(mysqli_num_rows($products)!=0){
            $connect->query("update products set status=0 where id=$id");
        }else{
            $connect->query("delete from products where id=$id");
            unlink("../images/".$_GET['image']);
        }
    }
?>
<?php
    $query="select*from products";
    $result=$connect->query($query);
?>
<?php
    $option='product';
    $page=1; //xem các sản phẩm ở trang số bnhieu
    if(isset($_GET['page'])){
        $page=$_GET['page'];       
    }
    //số lượng sản phẩm muốn để mỗi trang
    $productsperpage=10;
    //lấy các sản phẩm bắt đầu từ chỉ số bn trong bảng(0 là bắt đầu từ bản ghi đầu tiên)
    $from=($page-1)*$productsperpage;
    //lấy tổng số sản phẩm
    $totalProducts=$connect->query($query);
    //tính tổng số trang có được
    $totalPages=ceil(mysqli_num_rows($totalProducts)/$productsperpage);
    //lấy các sản phẩm ở trang hiện thời
    $query.= " limit $from,$productsperpage";
    $result=$connect->query($query);
?>
<div class="col-3 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sản phẩm</h1>
</div>
<div class="col-6">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" onsubmit="return validateSearch()">
        <div class="input-group" style="border: 2px solid; border-radius: 8px;">
            <input type="hidden" name="option" value="productsearch">
            <input type="text" name="keyword" class="form-control bg-light border-0 small" autocomplete="off" style="border-radius: 8px;" placeholder="Tìm kiếm..."
                aria-label="Search" aria-describedby="basic-addon2">
                <button class="input-group-text">
                    <i class="fas fa-search fa-sm"></i>
                </button>
        </div>
    </form>
</div>
<div class="col-3"><a href="?option=productadd" class="btn btn-success">Thêm sản phẩm</a></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá nhập</th>
            <th>Giá bán</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Thực thi</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=$from + 1;?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['name']?></td>
                <td><?=number_format($item['price_original'],0,',','.')?>đ</td>
                <td><?=number_format($item['discount'],0,',','.')?>đ</td>
                <td width="20%"><img src="../images/<?=$item['image']?>" width="50%"></td>
                <td><?=$item['status']==1?'Hoạt động':'Khóa'?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=productupdate&id=<?=$item['id']?>">Sửa</a>
                <a class="btn btn-sm btn-danger" href="?option=product&id=<?=$item['id']?>&image=<?=$item['image']?>" onclick="return confirm('Bạn có chắc chắn không?')">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<section class="pages text-center">
    <span class="text-secondary">Trang </span>
    <?php for($i=1; $i<=$totalPages;$i++):?>
        <a class="<?=(empty($_GET['page'])&&$i==1)||(isset($_GET['page'])&&$_GET['page']==$i)?'underline':''?>" 
        href="?option=<?=$option?>&page=<?=$i?>"><?=$i?></a>
    <?php endfor;?>
</section>
<script>
    function validateSearch() {
        const keyword = document.querySelector('input[name="keyword"]').value;
        if (keyword.trim() === '') {
            alert('Vui lòng nhập từ khóa tìm kiếm');
            return false; // Ngăn chặn gửi form
        }
        saveSearchHistory(keyword);
        hideSearchHistory();
        return true; // Cho phép gửi form
    }
</script>