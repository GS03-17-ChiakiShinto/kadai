<?php
//1.  DB接続します
  $pdo = new PDO('mysql:dbname=an;host=localhost','root','');


//2. DB文字コードを指定（固定）
$stmt = $pdo->query('SET NAMES utf8');

//３．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM an_table");

//４．SQL実行
$flag = $stmt->execute();

//データ表示
$view="";
if($flag==false){
  $view = "SQLエラー";
}else{
  //Select→データの数だけ自動でループ処理
  //$resultに1レコードずつ入る
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //5.表示文字列を作成→変数に追記で代入
    //$view .= '<p>'.$result['****'].','.$result['****'].'</p>';
	$view .= '<p>'.$result['sex'].','.$result['age'].','.$result['kotoba'].','.$result['indate']."<br>";
  }
}

$stmt = $pdo->prepare("select count(*) from an_table");
$flag_count_record = $stmt->execute();
$record = "";
if($flag_count_record==false){
	$male = "レコード数確認用SQLエラー";
}else{
	while( $count_record_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$record .= '<p>'.$count_record_result['count(*)'].'</p>';
		$record = $count_record_result['count(*)'];
	}
}

$stmt = $pdo->prepare("select sum(case when sex='男性' then 1 else 0 end) from an_table");
$flag_count_male = $stmt->execute();
$male = "";
if($flag_count_male==false){
	$male = "男性の数確認用SQLエラー";
}else{
	while( $count_male_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$male .= '<p>'.$count_male_result["sum(case when sex='男性' then 1 else 0 end)"].'</p>';
		$male = $count_male_result["sum(case when sex='男性' then 1 else 0 end)"];
	}
}

$stmt = $pdo->prepare("select sum(case when sex='女性' then 1 else 0 end) from an_table");
$flag_count_female = $stmt->execute();
$female = "";
if($flag_count_female==false){
	$female = "女性の数確認用SQLエラー";
}else{
	while( $count_female_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$female .= '<p>'.$count_female_result["sum(case when sex='女性' then 1 else 0 end)"].'</p>';
		$female = $count_female_result["sum(case when sex='女性' then 1 else 0 end)"];
	}
}

//テキスト入力欄で入力した文字列の出現回数を数える
//出現回数に応じてフォントサイズ変更（タグクラウドの様に表示させる）
$stmt = $pdo->prepare("select kotoba, count(kotoba) from an_table group by kotoba");
$flag_count = $stmt->execute();
$count = "";
if($flag_count==false){
	$count = "カウント用SQLエラー";
}else{
	while( $count_result = $stmt->fetch(PDO::FETCH_ASSOC)){
		//SQL文で取得した内容を確認
		//$count .= '<p>'.$count_result['kotoba'].','.$count_result['count(kotoba)'].'</p>';
		if($count_result['count(kotoba)'] >= 10){
			$font_size = "30px";			
		}elseif($count_result['count(kotoba)'] >= 7){
			$font_size = "24px";
		}elseif($count_result['count(kotoba)'] >= 5){
			$font_size = "16px";
		}elseif($count_result['count(kotoba)'] >= 3){
			$font_size = "12px";
		}else{
			$font_size = "10px";
		}
		
		$count .= '<a style="font-size: '.$font_size.'" href="http://ja.wikipedia.org/wiki/'.$count_result['kotoba'].'">'.$count_result['kotoba'];
	}
}
?>


	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>フリーアンケート表示</title>
		<link rel="stylesheet" href="css/range.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<style>
			div {
				padding: 10px;
				font-size: 16px;
			}
		</style>
	</head>

	<body id="main">
		<!-- Head[Start] -->
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">データ登録</a>
					</div>
			</nav>
		</header>
		<!-- Head[End] -->

		<!-- Main[Start] -->
		<div>
			<!--<div class="container jumbotron"><//?= $view ?></div>-->
			<h2>回答数</h2>
			<div class="container jumbotron">
				<?= $record ?>
			</div>
			<h2>回答した人</h2>
			<div class="container jumbotron">
				男性<?= round($male/$record * 100) ?>%
				<br>
				女性<?= round($female/$record * 100) ?>%</div>
			<h2>回答者の気になっている言葉</h2>
			<div class="container jumbotron">
				<?= $count ?>
			</div>
		</div>
		</div>
		<!-- Main[End] -->

	</body>

	</html>