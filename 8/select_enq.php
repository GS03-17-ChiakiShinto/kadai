<?php
//1.  DB接続します
  try{
  $pdo = new PDO('mysql:dbname=an;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//2. DB文字コードを指定（固定）
$stmt = $pdo->query('SET NAMES utf8');
if (!$stmt) {
  $error = $pdo->errorInfo();
  exit("DB文字コード設定エラー:".$error[2]);
}

//３．データ登録SQL作成（最新の回答のみ抽出する）
$stmt = $pdo->prepare("SELECT * FROM an_table ORDER BY id DESC LIMIT 1");

//４．SQL実行
$flag = $stmt->execute();

//データ表示
$view="";
if($flag==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);	
  //$view = "SQLエラー";
}else{
  //Select→データの数だけ自動でループ処理
  //$resultに1レコードずつ入る
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
	  //5.表示文字列を作成→変数に追記で代入
	  $view .= '<p><a href="detail_enq.php?id='.$result["id"].'">'.$result['sex'].','.$result['age'].','.$result['kotoba'].','.$result['indate'].'</a></p>';
  }
}

$stmt = $pdo->prepare("SELECT COUNT(*) FROM an_table");
$flag_count_record = $stmt->execute();
$record = "";
if($flag_count_record==false){
	$male = "レコード数確認用SQLエラー";
}else{
	while( $count_record_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$record .= '<p>'.$count_record_result['count(*)'].'</p>';
		$record = $count_record_result['COUNT(*)']; //''内はSQL文に合わせる（SQL文で大文字を使用したら、こちらでも大文字
	}
}

$stmt = $pdo->prepare("SELECT SUM(CASE WHEN sex='男性' THEN 1 ELSE 0 END) FROM an_table");
$flag_count_male = $stmt->execute();
$male = "";
if($flag_count_male==false){
	$male = "男性の数確認用SQLエラー";
}else{
	while( $count_male_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$male .= '<p>'.$count_male_result["sum(case when sex='男性' then 1 else 0 end)"].'</p>';
		$male = $count_male_result["SUM(CASE WHEN sex='男性' THEN 1 ELSE 0 END)"];
		$male_parcentage = round($male/$record * 100);
	}
}

$stmt = $pdo->prepare("SELECT SUM(CASE WHEN sex='女性' THEN 1 ELSE 0 END) FROM an_table");
$flag_count_female = $stmt->execute();
$female = "";
if($flag_count_female==false){
	$female = "女性の数確認用SQLエラー";
}else{
	while( $count_female_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$female .= '<p>'.$count_female_result["sum(case when sex='女性' then 1 else 0 end)"].'</p>';
		$female = $count_female_result["SUM(CASE WHEN sex='女性' THEN 1 ELSE 0 END)"];
		$female_parcentage = round($female/$record * 100);
	}
}

//テキスト入力欄で入力した文字列の出現回数を数える
//出現回数に応じてフォントサイズ変更（タグクラウドの様に表示させる）
$stmt = $pdo->prepare("SELECT kotoba, COUNT(kotoba) FROM an_table GROUP BY kotoba");
$flag_count = $stmt->execute();
$count = "";
if($flag_count==false){
	$count = "カウント用SQLエラー";
}else{
	while( $count_result = $stmt->fetch(PDO::FETCH_ASSOC)){
		//SQL文で取得した内容を確認
		//$count .= '<p>'.$count_result['kotoba'].','.$count_result['count(kotoba)'].'</p>';
		if($count_result['COUNT(kotoba)'] >= 15){
			$font_size = "40px";			
		}elseif($count_result['COUNT(kotoba)'] >= 12){
			$font_size = "36px";
		}elseif($count_result['COUNT(kotoba)'] >= 10){
			$font_size = "32px";
		}elseif($count_result['COUNT(kotoba)'] >= 5){
			$font_size = "28px";
		}else{
			$font_size = "20px";
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
		<link rel="stylesheet" href="css/select_enq.css">
		<link rel="stylesheet" href="css/range.css">
		<script src="Chart.js/Chart.js"></script>
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
	<div id=resent_answer>
		<h2>最近の回答</h2>
		<h4>リンクをクリックすると編集できます</h4>
		<div class="container jumbotron">
			<?= $view ?>
		</div>
		<div>
			<h2>回答数: <?= $record ?></h2>
		</div>
		<div id="male_to_female_ratio">
			<h2>回答した人</h2>
			<!--Chart.js使って円グラフ描く-->
			<!-- 描画エリア -->
			<canvas id="pieArea" height="350" width="960"></canvas>

			<script>
				//円グラフ用データ
				var male = <?php echo $male_parcentage; ?>;
				var female = <?php echo $female_parcentage; ?>;
				var pieData = [{
					value: male,
					color: "#87CEEB"
				}, {
					value: female,
					color: "#FFB6C1"
				}, ];
				//オプション項目セット
				var pieOption = {
					segmentStrokeColor: "#666", // 区切り線の色
					segmentStrokeWidth: 2, // 区切り線の太さ
					animation: true // アニメーション有無
				};
				<!-- 円グラフ描画 -->
				var myPie = new Chart(document.getElementById("pieArea").getContext("2d")).Pie(pieData, pieOption);
			</script>
			<p>
				男性<?= $male_parcentage; ?>%
				女性<?= $female_parcentage; ?>%
			</p>
		</div>
		<div id="words">
			<h2>好きな言語、興味があること</h2>
			<div class="container jumbotron">
				<?= $count ?>
			</div>
		</div>	
	</div>
	<!-- Main[End] -->

</body>

	</html>