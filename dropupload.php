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
#drag-drop-area {
  width: 300px;
  height: 200px;
  background: #EEE;
  border: dotted 3px #666;
  text-align: center;
  padding: 20px;
}
p.drag-drop-buttons {
  display: none;
}
input[type="submit"] {
  margin: 40px
}
</style>

</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">
    <div id="drag-drop-area">
      <div class="drag-drop-inside">
        <p class="drag-drop-info">ここにファイルをドロップ</p>
        <p>または</p>
        <input type="file" value="ファイルを選択" name="image">
        <p class="drag-drop-buttons"><input id="fileInput" type="file" value="ファイルを選択" name="image"></p>
        <input type="submit" value="送信">
      </div>
    </div>
  </form>


  <script type="text/javascript">
  var fileArea = document.getElementById('drag-drop-area');
  var fileInput = document.getElementById('fileInput');


  fileArea.addEventListener('dragover', function(evt){
    evt.preventDefault();
    fileArea.classList.add('dragover');
  });

  fileArea.addEventListener('dragleave', function(evt){
      evt.preventDefault();
      fileArea.classList.remove('dragover');
  });
  fileArea.addEventListener('drop', function(evt){
      evt.preventDefault();
      fileArea.classList.remove('dragenter');
      var files = evt.dataTransfer.files;
      fileInput.files = files;
  });
  </script>
</body>
</html>
