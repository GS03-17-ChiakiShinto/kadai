<?php
session_start();
include('include/func.php'); //外部ファイル読み込み（関数群）

//idを取得[select.phpよりGETで取得]
if(isset($_GET["id"]) && $_GET["id"]!=""){
  $id = $_GET["id"];
}else{
  exit("Error");
}
//var_dump($id);

//select_enq.phpのページのセッションIDを比較し、ログイン認証済みかを判定
//ログイン認証してなければ処理がここでストップする。
sessionCheck(); // include/func.php に記載

//2.DB接続など
//2-1.DB接続
//1. 接続します
$pdo = connect_db(); // new PDO(...を関数として読み込み (include/func.php)

//2-2. DB文字コードを指定（固定） 
$stmt = dbCharSet($pdo);

//3.SELECT * FROM gs_an_tableを取得（一覧表示準備）
$stmt = $pdo->prepare("SELECT * FROM an_table");
$status = $stmt->execute();


//４．SQL実行エラーチェック
dbExecError($status,$stmt);

//select_enq.phpと同じようにデータを取得
$view_table="";
while( $get_id_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//テーブル形式で表示
	$view_table .= '<tr><td>'.$get_id_result["id"].'</td>'.'<td>'.$get_id_result["sex"].'</td>'.'<td>'.$get_id_result["age"].'</td>'.'<td>'.$get_id_result["kotoba"].'</td>'.'<td>'.$get_id_result["indate"].'</td></td>';
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>データ一覧</title>
	<link href="css/check_detail_enq.css" rel="stylesheet">
	<link href="css/input_enq.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		div {
			padding: 10px;
			font-size: 16px;
		}
	</style>
</head>

<body>

	<!-- Head[Start] -->
	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header"><a class="navbar-brand" href="select_enq.php">集計結果</a></div>
		</nav>
	</header>
	<!-- Head[End] -->

	<!-- Main[Start] -->
	<!-- データの送り先をupdate.phpにする-->
	<form method="post" action="update_enq.php">

		<h2>回答一覧</h2>
		<table border=1>
			<tr>
				<th>id</th>
				<th>性別</th>
				<th>年齢</th>
				<th>好きな言語、興味があることなど</th>
				<th>回答時間</th>
			</tr>
			<?= $view_table ?>
		</table>
	</form>
</body>

</html>