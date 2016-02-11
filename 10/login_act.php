<?php
session_start();
include('include/func.php'); //外部ファイル読み込み（関数群）

//POST受け取り
if( (isset($_POST["login_id"]) && $_POST["login_id"]!="") && (isset($_POST["login_pw"]) && $_POST["login_pw"]!="") ){
	$login_id = $_POST["login_id"];
	$login_pw = $_POST["login_pw"];
}else{
  //POSTがどちらか送信されてない、または、POSTデータのどちらかが未入力の場合はログインできないようにする
  exit;
}


//1. 接続します
// new PDO(...を関数として読み込み (include/func.php)
$pdo = connect_db();

//2. DB文字コードを指定
$stmt = dbCharSet($pdo);

//３．データ登録SQL作成
//delete_flgが1の時は「退会済（削除予定）」とする
$stmt = $pdo->prepare("SELECT * FROM an_admin_user_table WHERE login_id=:login_id AND login_pw=:login_pw AND delete_flag=0");
$stmt->bindValue(':login_id', $login_id);
$stmt->bindValue(':login_pw', $login_pw);
$status = $stmt->execute();

//SQL実行エラーチェック
dbExecError($status,$stmt);

//５．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//6. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
	//認証成功:
	loginSessionSet($val); // include/func.phpに関数を記述
  header("Location: concept.php");
}else{
  //認証失敗:logout処理を経由して前画面へ
  header("Location: logout.php");
}

exit();



?>

