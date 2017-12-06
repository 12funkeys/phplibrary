<?php

if (!isset($_FILES['image']['error']) || !is_int($_FILES['image']['error'])){
  echo "ファイルアップロードエラー";
} else {
  $file_name = $_FILES['image']['name'];
  $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得
  $tmp_path = $_FILES['image']['tmp_name'];
  $file_dir_path = "upload/";
  $uniq_name = date("YmdHis").md5(uniqid(microtime(),1)).session_id() . "." . $extension;

  if (is_uploaded_file($tmp_path)) {
    if(move_uploaded_file( $tmp_path, $file_dir_path . $uniq_name)) {
      chmod($file_dir_path . $uniq_name, 0644);
    } else {
      echo "Error:アップロードできませんでした。";
    }
  }
}
?>

<html>
<head>
<meta charset="utf-8">
<style>
#screen {
	position: fixed;
	top: 0;
	left: 0;
	pointer-events:none;
}
</style>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
  <input type="file" value="ファイルを選択" name="image">
  <input type="submit" value="送信">
</form>
</body>
</html>
