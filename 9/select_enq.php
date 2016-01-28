<?php
session_start();
include('include/func.php'); //外部ファイル読み込み（関数群）

//login_act.phpで取得したセッションIDを比較し、ログイン済か判定する
//ログイン認証してなければ処理がここでストップする。
sessionCheck(); // include/func.php に記載

//1.  DB接続します
$pdo = connect_db();


//2. DB文字コードを指定（固定）
$stmt = dbCharSet($pdo);


//３．データ登録SQL作成（最新の回答のみ抽出する）
$stmt = $pdo->prepare("SELECT * FROM an_table ORDER BY id DESC LIMIT 1");

//４．SQL実行
$status = $stmt->execute();

//SQL実行エラーチェック
dbExecError($status, $stmt);

//データ表示
$view="";
//Select→データの数だけ自動でループ処理
//$resultに1レコードずつ入る
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
	  //5.表示文字列を作成→変数に追記で代入
	  //管理FLGで表示を切り分け
	if( $_SESSION["admin_flag"]==1 ){
	  //管理者の場合[リンク有り]
	  $view .= '<p><a href="check_detail_enq.php?id='.htmlEnc($result["id"]).'">'.htmlEnc($result["sex"]).",".htmlEnc($result["age"]).",".htmlEnc($result["kotoba"]).",".htmlEnc($result["indate"]).'</a></p>';
  }else{
	  //一般の場合[リンク無しにしてみた]
	  $view .= '<p>'.htmlEnc($result["indate"]).' | '.htmlEnc($result["name"])." | ".htmlEnc($result["email"]).'</p>';
	}
}

//レコード数取得
$stmt = $pdo->prepare("SELECT COUNT(*) FROM an_table");
$status = $stmt->execute();

//SQL実行エラーチェック
dbExecError($status, $stmt);
$record = "";
while( $count_record_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$record .= '<p>'.$count_record_result['count(*)'].'</p>';
		$record = $count_record_result['COUNT(*)']; //''内はSQL文に合わせる（SQL文で大文字を使用したら、こちらでも大文字
	}

//「性別」が「男性」のレコード数取得
$stmt = $pdo->prepare("SELECT SUM(CASE WHEN sex='男性' THEN 1 ELSE 0 END) FROM an_table");
$status = $stmt->execute();

//SQL実行エラーチェック
dbExecError($status, $stmt);

$male = "";
while( $count_male_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$male .= '<p>'.$count_male_result["sum(case when sex='男性' then 1 else 0 end)"].'</p>';
		$male = $count_male_result["SUM(CASE WHEN sex='男性' THEN 1 ELSE 0 END)"];
		$male_parcentage = round($male/$record * 100);
}

//「性別」が「女性」のレコード数取得
$stmt = $pdo->prepare("SELECT SUM(CASE WHEN sex='女性' THEN 1 ELSE 0 END) FROM an_table");
$status = $stmt->execute();

//SQL実行エラーチェック
dbExecError($status, $stmt);

$female = "";
while( $count_female_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//SQL文で取得した内容を確認
		//$female .= '<p>'.$count_female_result["sum(case when sex='女性' then 1 else 0 end)"].'</p>';
		$female = $count_female_result["SUM(CASE WHEN sex='女性' THEN 1 ELSE 0 END)"];
		$female_parcentage = round($female/$record * 100);
}

//各年齢のレコード数取得
$stmt = $pdo->prepare("SELECT age, COUNT(age) FROM an_table GROUP BY age");
$status = $stmt->execute();

//SQL実行エラーチェック
dbExecError($status, $stmt);

$age_count="";
$age_choices="";
while( $age_result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//var_dump($age_result);
	$age_choices .= ' '.'"'.$age_result['age'].'"'.',';
	$age_count .= ' '.$age_result['COUNT(age)'].' ,';
}
$age_choices = substr($age_choices, 0, -1);
$age_choices .= '['.$age_choices.']';
$age_count = substr($age_count, 0, -1);//最後の「,」を削除

$age_count2="";
$age_count2 .= '['.$age_count.']';
//var_dump($age_choices);
//var_dump($age_count);

//テキスト入力欄で入力した文字列の出現回数を数える
//出現回数に応じてフォントサイズ変更（タグクラウドの様に表示させる）
$stmt = $pdo->prepare("SELECT kotoba, COUNT(kotoba) FROM an_table GROUP BY kotoba");
$status = $stmt->execute();

//SQL実行エラーチェック
dbExecError($status, $stmt);

$count = "";
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
?>


<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>集計結果表示</title>
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
					<a class="navbar-brand" href="logout.php">ログアウト</a>
				</div>
		</nav>
	</header>
	<!-- Head[End] -->

	<!-- Main[Start] -->
	<div id=resent_answer>
		<h2>最近の回答</h2>
		<h4>リンクをクリックすると一覧を表示できます</h4>
		<div class="container jumbotron">
			<?= $view ?>
		</div>
		<div>
			<h2>回答数: <?= $record ?></h2>
		</div>
		<div id="ratio">
			<h2>回答した人</h2>

			<!--Chart.js使ってグラフ描く-->
			<!-- 描画エリア -->
			<h3>年齢別内訳</h3>
            <canvas id="graph-area" height="350" width="960"></canvas>
			<br><br>
			<h3>男女比</h3>
			<canvas id="pieArea" height="350" width="960"></canvas>
			<script>
				// 棒グラフ(変数のとこでエラーになる）
				//var age = <//?php echo $age_choices; ?>;
				var num = <?php echo $age_count2; ?>;
				var barChartData = {
					labels: ["10代","20代","30代","40代","50代"],
					datasets: [
						{
						fillColor: "rgba(240,128,128,0.6)", // 塗りつぶし色
						strokeColor: "rgba(240,128,128,0.9)", // 枠線の色
						highlightFill: "rgba(255,64,64,0.75)", // マウスが載った際の塗りつぶし色
						highlightStroke: "rgba(255,64,64,1)", // マウスが載った際の枠線の色
						data: num // 各棒の値(カンマ区切りで指定)
						}
					]

				}

				// ▼上記のグラフを描画するための記述
				window.onload = function() {
						var ctx = document.getElementById("graph-area").getContext("2d");
						window.myBar = new Chart(ctx).Bar(barChartData);
				}

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
				男性
				<?= $male_parcentage; ?>% 女性
					<?= $female_parcentage; ?>%
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