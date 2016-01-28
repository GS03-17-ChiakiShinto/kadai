<?php
//DB接続
function connect_db(){
  try {
    return new PDO('mysql:dbname=an;host=localhost', 'root', '');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
}

//DB文字設定
function dbCharSet($pdo){
  $stmt = $pdo->query('SET NAMES utf8');
  if (!$stmt) {
    $error = $pdo->errorInfo();
    exit($error[2]);
  }
  return $stmt;
}

//SQL実行エラーチェック
function dbExecError($status,$stmt){
  if($status==false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }
}

//認証OK時の初期値セット
function loginSessionSet($val){
//$_POST["***"]と同様。メソッドがSESSIONに変わった。session idのチェック用に取得	
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["admin_flag"] = $val['admin_flag'];
  $_SESSION["name"]      = $val['name'];
}

//セッションチェック用関数
function sessionCheck(){
  if( !isset($_SESSION["chk_ssid"]) || ($_SESSION["chk_ssid"] != session_id()) ){
    echo "LOGIN ERROR";
    exit();
  }else{
     session_regenerate_id(true);
     $_SESSION["chk_ssid"] = session_id();
  }
}

//HTML XSS対策
function htmlEnc($value) {
    return htmlspecialchars($value,ENT_QUOTES);
}
?>
