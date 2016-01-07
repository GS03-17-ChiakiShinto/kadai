<html>

<head>
	<meta charset="utf-8">
	<title>アンケートのチェック</title>
</head>
<?php
	//テキスト入力欄、ラジオボタンの配列：account
	$account = $_POST['account'];
	$account_name = $account['name'];
	$account_email = $account['e-mail'];
	$account_age = $account['age'];
	$account_comment = $account['comment'];
	
	//xss対策
	$account_name = htmlspecialchars($account_name);
	$account_name = htmlspecialchars($account_email);
	$account_comment = htmlspecialchars($account_comment);
	//print_r($account);
	//チェックボックスの回答を受け取る(チェックボックスはいったん別物として扱う。accountには枠が1つしかないため、複数選択時に最後に選択したものみに上書きされる)
	//チェックボックスのXSS対策は未実装
	$hobby = $_POST['hobby'];
	//$hobby = htmlspecialchars($hobby);
	//print_r($hobby);
	
	if($account['name'] ==''){
		print '名前が入力されていません<br>';
	}
	
	if($account['e-mail'] ==''){
		print 'メールアドレスが入力されていません<br>';
	}
//名前かメールアドレスが入力されていない場合は戻るボタンを出し、再入力を促す。js文を入れることで途中入力情報を保持
	if($account['name'] =='' || $account['e-mail'] == ''){
		print'<form>';
		print'<input type="button" onclick="history.back()" value="アンケートに戻る">';
			print'<form>';
	}else{
		print'<form method="post" action="input_finish_20151228.php">';
		print'<p>名前:'.$account['name'].'</p>';
		//print'<input name="account[name]" type="" value="'.$account['name'].'">';
		print'<p>メールアドレス:'.$account['e-mail'].'</p>';
		//print'<input name="account[e-mail]" type="" value="'.$account['e-mail'].'">';
		print'<p>年齢:'.$account['age'].'</p>';
		//print'<input name="account[age]" type="" value="'.$account['age'].'">';
		print'<p>性別:'.$account['sex'].'</p>';
		//print'<input name="account[sex]" type="" value="'.$account['sex'].'">';
		print'<p>趣味:</p>';
		print_r($hobby);
		print'<p>コメント:'.$account['comment'].'</p>';
		//print'<input name="account[comment]" type="" value="'.$account['comment'].'">';
		print'<p>入力内容に間違いがなければOKをクリックしてください:</p>';
		print'<input type="button" onclick="history.back()" value="アンケートに戻る">';
		print'<input type="submit" value="OK">';
		print'</form>';
		$all_answer = array_merge($account, $hobby);
	//	print_r($all_answer);
	}
	$ans_array = $all_answer;
	print_r($ans_array);
?>

</html>