<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>アンケート回答フォーム</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
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
	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header"><a class="navbar-brand" href="select_enq.php">データ一覧</a></div>
			</div>
		</nav>
	</header>
	<main>
				<!--アンケートフォーム作成。「回答完了」ボタンを押すとinput_finish.phpへ遷移する-->
				<form action="insert_enq.php" method="POST">
					<p>
					<h4>性別</h4>
					
					<input type="radio" name="account[sex]" value="男性" checked>男性
					<input type="radio" name="account[sex]" value="女性">女性
					</p>
					<br>
					<p>
					<h4>年齢</h4>
						<tr>
							<td>
								<select name="account[age]" size="1">
									<option value="10代">10代</option>
									<option value="20代">20代</option>
									<option value="30代">30代</option>
									<option value="40代">40代</option>
									<option value="50代">50代</option>
								</select>
							</td>
						</tr>
					</p>
					<br>
					<p>
						<h4>好きな言語、興味があることなど</h4>
					</p>
					<textarea type="text" name="account[kotoba]" cols="10" rows="2" placeholder=""></textarea>
					<div id="submit">
						<input type="submit" name="Submit" value="回答完了">
					</div>
				</form>
		</main>
</body>

</html>