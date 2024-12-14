<?php 
    $brand=mysqli_fetch_array($connect->query("select*from brands where id=".$_GET['id']));
?>
<?php
    if(isset($_POST['name'])){
        $name=$_POST['name'];
        $query="select*from brands where name='$name' and id!=".$brand['id'];
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Đã có hãng trùng tên này!";
        }else{
            $status=$_POST['status'];
            $connect->query("update brands set name='$name',status='$status' where id=".$brand['id']); 
            echo"<script>location='?option=brand';</script>";
        }
    }
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=brand"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a> Sửa thương hiệu</h1>
</div>
<section style="color: red; text-align:center"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label>Tên thương hiệu: </label><input value="<?=$brand['name']?>" name="name" class="form-control" required>
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" <?=$brand['status']==1?'checked':''?>> 
            Hoạt động <input type="radio" name="status" value="0" <?=$brand['status']==0?'checked':''?>> Khóa
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-success">
        </section>
    </form>   
</section>