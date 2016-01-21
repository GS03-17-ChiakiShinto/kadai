<?php
//1. POSTデータ取得
 $account = $_POST['account'];
 if(
	 !isset($account['sex']) || $account['sex']=="" ||
	 !isset($account['age']) || $account['age']=="" ||
	 !isset($account['kotoba']) || $account['kotoba']==""
 ){
	exit('ParamError'); 
 }

//var_dump($account);

//$accountに格納された各データ：
//$account['id'],$account['sex'],$account['age'],$account['kotoba']

  //2. DB接続します
  //PDO：オブジェクト
  //$pdo = new PDO('mysql:dbname=****;host=****','****','****');
try{
$pdo = new PDO('mysql:dbname=an;host=localhost','root','');
} catch(PDOException $e) {
	exit('DB-ConnectError:'.$e->getMessage());
}
//var_dump($pdo);

//2. DB文字コードを指定(固定)
$stmt = $pdo->query('SET NAMES utf8');
if (!$stmt) {
  $error = $pdo->errorInfo();
  exit('文字コード指定エラー'.$error[2]);
}
//var_dump($stmt);


//３．データ登録SQL作成
//$stmt = $pdo->prepare("INSERT INTO **** (id, name, email, naiyou, indate )VALUES(NULL, :a1, :a2, :a3, sysdate())");
$stmt = $pdo->prepare("UPDATE an_table SET sex=:a1, age=:a2, kotoba=:a3 WHERE id=:a4");
//var_dump($stmt);


//svar_dump($stmt);
//bindValueに入れることでSQLインジェクションを防ぐ
//:a1に$nameを渡す
  $stmt->bindValue(':a1', $account['sex']);
  $stmt->bindValue(':a2', $account['age']);
  $stmt->bindValue(':a3', $account['kotoba']);
  $stmt->bindValue(':a4', $account['id']);
  $status = $stmt->execute();


  //４．データ登録処理後
  if($status==false){
    //Errorの場合$status=falseとなり、エラー表示
	$error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);  
    //echo "SQLエラー";
    exit;
  }else{
    //５．select_enq.phpへリダイレクト(このファイルではデータ更新のみにするため)
	header("Location: select_enq.php");
		  exit;
  }
?>