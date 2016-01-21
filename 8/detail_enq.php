<?php

//1.GETでidを取得
$id = $_GET['id'];
//var_dump($id);

//2.DB接続など
//2-1.DB接続
try{ $pdo = new PDO('mysql:dbname=an;host=localhost','root','');
  }catch (PDOException $e){
	exit('データベースに接続できませんでした。'.$e->getMessage()); 
}
//2-2. DB文字コードを指定（固定） 
$stmt = $pdo->query('SET NAMES utf8'); 
if (!$stmt) {
	$error = $pdo->errorInfo(); exit("DB文字コード設定エラー:".$error[2]);
}
//3.SELECT * FROM gs_an_table WHERE id=***; を取得
$stmt = $pdo->prepare("SELECT * FROM an_table WHERE id=".$id);

//4.select.phpと同じようにデータを取得（以下はイチ例）
$flag = $stmt->execute(); //3のSQL実行
$view_get_id_result = "";
if($flag==false){ 
	//execute（SQL実行時にエラーがある場合
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
	//$view = "SQLエラー";
}else{
	while( $get_id_result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$db_id = $get_id_result["id"];
		$sex = $get_id_result["sex"];
		$age = $get_id_result["age"];
		$kotoba = $get_id_result["kotoba"];
		$indate = $get_id_result["indate"];
		//データを正常に取得できていることを確認
		$view_get_id_result .= '<p>'.$db_id.','.$sex.','.$age.','.$kotoba.','.$indate.'</p>';
		$hidden_id="";
		//idは非表示のまま
		$hidden_id .= '<input type="hidden" name="account[id]" value="'.$db_id.'"></input>';
		//選択されたidに紐づく情報についてDBに登録された通りに表示させる
		//性別
		$view_sex = ""; //おまじない？（「undefined」Noticeが出ないようにする）
		if($sex == '男性'){
			$view_sex .= '<input type="radio" name="account[sex]" value="男性" checked>男性<input type="radio" name="account[sex]" value="女性" >女性';
		}elseif($sex == '女性'){
			$view_sex .= '<input type="radio" name="account[sex]" value="男性">男性<input type="radio" name="account[sex]" value="女性" checked>女性';
		}
		//年齢（input_enq.phpで選択された回答が選択済の状態にする）
		$view_age = "";
		$age_num = 10;
		while ($age_num <= 50){
				if($age == $age_num."代"){
					$view_age .=  '<option value="'.$age_num.'代" selected >'.$age_num.'代</option>';
				}else{
					$view_age .=  '<option value="'.$age_num.'代">'.$age_num.'代</option>';
				}
			//var_dump($view_age);
			$age_num = $age_num + 10;
			}
		//自由入力
		$view_text = "";
		$view_text .= '<textarea type="text" name="account[kotoba]" cols="10" rows="2" placeholder="">'.$kotoba.'</textarea>';
		}
}

?>
	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<meta charset="UTF-8">
		<title>POSTデータ登録</title>
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
					<div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
			</nav>
		</header>
		<!-- Head[End] -->

		<!-- Main[Start] -->
		<!-- データの送り先をupdate.phpにする-->
		<form method="post" action="update_enq.php">
			
			<h2>回答の編集</h2>
			<div class="jumbotron">
				<fieldset>
					<?= $hidden_id ?>
					<p>
						性別：
					
					<?= $view_sex ?>
					</p>	
					<br>
					<p>
						年齢：
						<tr>
							<td>
								<select name="account[age]" size="1">
									<?= $view_age ?>
								</select>
							</td>
						</tr>
					</p>
					<br>
					<p>
						好きな言語、興味があることなど：
					</p>
					<?= $view_text ?>
					<div id="submit">
						<input type="submit" value="送信">
					</div>	
				</fieldset>
				</div>
		</form>
		<!-- Main[End] -->


	</body>

	</html>