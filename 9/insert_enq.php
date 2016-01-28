<?php
//1. POSTデータ取得（）
 $account = $_POST['account'];
 if(
	 !isset($account['sex']) || $account['sex']=="" ||
	 !isset($account['age']) || $account['age']=="" ||
	 !isset($account['kotoba']) || $account['kotoba']==""
 ){
	exit('ParamError'); 
 }



//$accountに格納された各データ：
//$account['sex'],$account['age'],$account['kotoba']
//var_dump($account);

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
$stmt = $pdo->prepare("INSERT INTO an_table (id, sex, age, kotoba, indate )VALUES(NULL, :a1, :a2, :a3, sysdate())");
//var_dump($stmt);


//svar_dump($stmt);
//bindValueに入れることでSQLインジェクションを防ぐ
//:a1に$nameを渡す
  $stmt->bindValue(':a1', $account['sex']);
  $stmt->bindValue(':a2', $account['age']);
  $stmt->bindValue(':a3',$account['kotoba']);
  $status = $stmt->execute();


//４．データ登録処理後
  if($status==false){
    //Errorの場合$status=falseとなり、エラー表示
	$error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);  
    //echo "SQLエラー";
    exit;
  }//else{
    //５．index.phpへリダイレクト(このファイルではデータ登録のみにするため)
   //exitを残すと何故かbodyタグ内が表示されないのでコメントアウト
	  //header("Location: index.php");
		  //exit;
  //}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<link rel="stylesheet" href="css/index.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ありがとうございました</title>
</head>

<body>
	<form method="post" action="select_enq.php">
		<h2>ご協力ありがとうございました</h2>
		<div class="button">
			<input type="button" value="戻る" onclick="location.href='http://gsacademy.tokyo/'">
			<!--可能であれば、再編集画面への遷移を追加-->
		</div>
	</form>	

		<!-- Head[Start] -->
		<!-- Head[End] -->

		<!-- Main[Start] -->
		<div>

		</div>
		</div>
		<!-- Main[End] -->

</body>

</html>