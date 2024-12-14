<?php 
    $imagebanner=mysqli_fetch_array($connect->query("select*from imagebanner where id=".$_GET['id'])); 
?>
<?php
    if(isset($_POST['status'])){
            $bannerid=$_POST['bannerid'];
            $status=$_POST['status'];
            //Xử lý ảnh
            $store="../images/";
            $imageName=$_FILES['image']['name'];
            $imageTemp=$_FILES['image']['tmp_name'];
            $exp3=substr($imageName, strlen($imageName)-3); #aocd.jpg, ABCD1234.JPG
            $exp4=substr($imageName, strlen($imageName)-4); #jpeg, webp
            if($exp3=='jpg'||$exp3=='png'||$exp3=='bmp'||$exp3=='gif'||$exp3=='JPG'||$exp3==
                'PNG'||$exp3=='BMP'||$exp3=='GIF'||$exp4=='jpeg'||$exp4=='JPEG'||$exp4=='webp'||$exp4=='WEBP') {
                $imageName=time().'_'.$imageName;
                move_uploaded_file($imageTemp, $store.$imageName);
                if(!empty($imagebanner['image'])){ 
                    unlink($store.$imagebanner['image']); 
                }
            }else {
                    $alert = "Định dạng file không hợp lệ. Vui lòng chọn file ảnh.";
            }
            if(empty($imageName)){
                $imageName=$imagebanner['image'];
            }
            
            $connect->query("update imagebanner set bannerid='$bannerid',status='$status',image='$imageName' where id=".$imagebanner['id']);

            echo"<script>location='?option=banner';</script>";
        
    }
?>
<?php
    $banners=$connect->query("select*from banner");
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=banner"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a> Sửa banner</h1>
</div>
<section style="color: red; text-align:center"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Banner: </label>
            <select name="bannerid" class="form-control">
                <option hidden>--Chọn loại--</option>
                <?php foreach($banners as $item):?>
                    <option value="<?=$item['id']?>" <?=$item['id']==$imagebanner['bannerid']?'selected':''?>><?=$item['name']?></option>
                <?php endforeach;?>
            </select>
        </section>
        <section class="form-group">
            <label>Ảnh:</label><br>
            <img src="../images/<?=$imagebanner['image']?>" style="max-width: 600px;">
            <input type="file" name="image" class="form-control">
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" <?=$imagebanner['status']==1?'checked':''?>>
            Hoạt động <input type="radio" name="status" value="0" <?=$imagebanner['status']==0?'checked':''?>> Khóa
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-success">
        </section>
    </form>   
</section>