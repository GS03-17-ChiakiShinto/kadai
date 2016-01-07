<html>

<head>
	<meta charset="utf-8">
	<title>ありがとうございました</title>
	<link rel="stylesheet" href="css/input_finish.css">
	<meta name="keywords" content="">
	<meta name="description" content="">
</head>

<body>
	<h2>ご協力ありがとうございました。</h2>
	<div class="button">
		<input type="button" id="back_to_top" value="Topに戻る" onclick="location.href='index.php'">
		<input type="button" id="go_to_result" value="回答結果へ" onclick="location.href='show_enq.php'">
	</div>
	<?php
	//テキスト入力欄、ラジオボタンの配列：account
	$account = $_POST['account'];
	//print('name:'.$account['name']. '<br>');
	//print('e-mail:'.$account['e-mail']. '<br>');
	//print('age:'.$account['age']. '<br>');
	//print_r($ans_array);
	//チェックボックスの回答を受け取る(チェックボックスはいったん別配列として扱う。accountには枠が1つしかないため、複数選択時に最後に選択したものに上書きされる)
	$hobby = $_POST['hobby'];
	//2つの配列をマージ
	$all_answer = array_merge($account, $hobby);
	//確認
	//print_r($all_answer);
	
	//CSV形式に変換
	//windowsではファイルパスで用いる全てのバックスラッシュを エスケープするかフォワードスラッシュを使用する必要がある
	$csvfile = fopen('C:\\xampp\\htdocs\\kadai\\6\\data.csv','a');
	flock($csvfile,LOCK_EX);
	//filesizeには文字列を渡す必要がある
	if(filesize('C:\\xampp\\htdocs\\kadai\\6\\data.csv') === 0){
	$item = ['名前','メールアドレス','年齢','性別','コメント','趣味1','趣味2','趣味3'];
	//excel等での確認用（UTF-8からSJISに変換）
	//mb_convert_variables('SJIS-win','UTF-8',$item);
	fputcsv($csvfile,$item);	
		}
	//excel等での確認用（UTF-8からSJISに変換）
	//mb_convert_variables('SJIS-win','UTF-8',$all_answer);
	fputcsv($csvfile,$all_answer);
	flock($csvfile,LOCK_UN);
	fclose($csvfile);
	?>
</body>

</html>