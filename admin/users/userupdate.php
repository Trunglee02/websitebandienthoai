<?php 
    $user=mysqli_fetch_array($connect->query("select*from member where id=".$_GET['id']));
?>
<?php
    if(isset($_POST['status'])){
        $status=$_POST['status'];
        $connect->query("update member set status='$status' where id=".$user['id']); 
        echo"<script>location='?option=user';</script>";
    }
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=user"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a> Sửa trạng thái</h1>
</div>
<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" <?=$user['status']==1?'checked':''?>> 
            Hoạt động <input type="radio" name="status" value="0" <?=$user['status']==0?'checked':''?>> Khóa
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-success">
        </section>
    </form>   
</section>