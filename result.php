<?php
// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $file = $_FILES['fileName'];
    $fileTMP = $file['tmp_name'];
    $fileError = $file['error'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    if($fileError === 0){
        $targetDir = "./uploads/";
        $LimitSize = 2097152;
        // Lấy extension của file
        $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

        // Lấy mảng chứa danh sách extension cho file ảnh
        $allowExt = ['jpg','jpeg','png'];
        if (in_array($fileExt,$allowExt)) {
            if($fileSize <= $LimitSize){
                // $change_name = uniqid() .".". $fileExt;
                if(move_uploaded_file($fileTMP,$targetDir.$fileName)){
                echo "Upload ảnh thành công ảnh ở địa chỉ <a href='uploads/$fileName' target='_blank'>/uploads/$fileName</a> ";
                }
                else{
                echo 'Upload ảnh failed';
                }
            }
            else{
                echo 'Chỉ được upload ảnh tối đa 2MB';
            }
                
        }
        else {
            echo 'File không hợp lệ';
        }
    }
    else{
    echo 'Lỗi upload ảnh';
    }
}
?>