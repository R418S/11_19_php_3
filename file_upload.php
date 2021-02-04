<?php
//var_dump($_FILES);
//exit();

// ファイルが追加されていない or エラー発生の場合を分ける. // 送信されたファイルは$_FILES['...'];で受け取る!
// コード
if (!isset($_FILES['upfile']) || $_FILES['upfile']['error'] != 0){
// 送られていない，エラーが発生，などの場合
exit('画像が送信されていません');
} else {
// 送信が正常に行われたときの処理(この後記述)
$uploaded_file_name = $_FILES['upfile']['name'];
$temp_path = $_FILES['upfile']['tmp_name'];
$directory_path = 'upload/';

$extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
$unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
$filename_to_save = $directory_path . $unique_name;
// var_dump($filename_to_save);
// exit();
if(!is_uploaded_file($temp_path)){
  exit('画像がないです');
} else {
  if(!move_uploaded_file($temp_path, $filename_to_save)){
    exit('アップロードに失敗しました');
  } else{
    chmod($filename_to_save, 0644);
    $img = "<img src={$filename_to_save}>";
  }
}
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>file_upload</title>
</head>

<body>
  <?= $img ?>
</body>

</html>