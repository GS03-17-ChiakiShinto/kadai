<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/input_enq.css">
	<title>アンケート回答フォーム</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
</head>

<body>
	<!--アンケートフォーム作成。「回答完了」ボタンを押すとinput_finish.phpへ遷移する-->
	<form action="input_finish.php" method="POST">
		<p>
			名前：
			<input type="text" name="account[name]">
		</p>
		<p>
			メールアドレス：
			<input type="text" name="account[e-mail]">
		</p>
		<p>
			年齢：
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
		<p>
			性別：
		</p>
		<input type="radio" name="account[sex]" value="男性" checked>男性
		<input type="radio" name="account[sex]" value="女性">女性
		<br>
		<p>

		</p>
		<p>
			趣味（3つまで）：
		</p>
		<!--チェックボックスの value の値は$_POST[hobby][0], $_POST[hobby][1],…に格納される。hobbyはname属性部分-->
		<!--一度別配列に格納し、別途account配列に追加する-->
		<input type="checkbox" name="hobby[]" value="読書">読書
		<input type="checkbox" name="hobby[]" value="スポーツ">スポーツ
		<input type="checkbox" name="hobby[]" value="映画">映画
		<input type="checkbox" name="hobby[]" value="写真">写真
		<input type="checkbox" name="hobby[]" value="音楽">音楽
		<input type="checkbox" name="hobby[]" value="旅行">旅行
		<input type="checkbox" name="hobby[]" value="アウトドア">アウトドア

		<p>
			その他：
		</p>
		<textarea type="text" name="account[comment]" cols="40" rows="7" placeholder="コメント等自由にお書きください"></textarea>
		<div>
			<input type="submit" name="Submit" value="回答完了">
		</div>
</body>

</html>
