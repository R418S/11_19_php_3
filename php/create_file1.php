<?php
session_start();
include("functions.php");
check_session_id();

if (
  !isset($_POST['title']) || $_POST['title'] == '' ||
  !isset($_POST['messages']) || $_POST['messages'] == ''
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// 受け取ったデータを変数に入れる
$title = $_POST['title'];
$messages = $_POST['messages'];


// ここからファイルアップロード&DB登録の処理を追加しよう！！！
if (!isset($_FILES['upfile']) || $_FILES['upfile']['error'] != 0) {
  exit('Error:画像が送信されていません');
} else {
  $uploaded_file_name = $_FILES['upfile']['name'];
  $temp_path = $_FILES['upfile']['tmp_name'];
  $directory_path = 'upload/';

  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;

  $img = '';
  if (!is_uploaded_file($temp_path)) {
    exit('Error:画像がありません');
  } else {
    if (!move_uploaded_file($temp_path, $filename_to_save)) {
      exit('Error:アップロードできませんでした');
    } else {
      chmod($filename_to_save, 0644);
    }
  }
}
$pdo = connect_to_db();

$sql = 'INSERT INTO kanso_table(id, title, messages, image, created_at, updated_at) VALUES(NULL, :title, :messages, :image, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':messages', $messages, PDO::PARAM_STR);
$stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:kanso_input.php");
  exit();
}

?>
