<html>

<head>
	<meta charset="utf-8">
	<title>集計結果</title>
	<link rel="stylesheet" href="css/show_enq.css">
	<meta name="keywords" content="">
	<meta name="description" content="">
</head>

<body>
	<h2>集計結果</h2>
	<!--<div class="button">
		<input type="button" id="csv_download" value="CSVダウンロード" onclick="">
	</div>-->
	<?php
	//input_finish.phpで作ったcsvファイルを読み込む
	$csv = fopen('C:\\xampp\\htdocs\\kadai\\6\\data.csv','r');
	flock($csv,LOCK_SH);
	echo '<table border="1">';
	while($array = fgetcsv($csv)){
		echo "\t<tr>\n";
		$num = count($array);
		for($i=0;$i<$num;$i++){
			echo "\t\t<td>{$array[$i]}</td>\n";
			//echo $array[$i];
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";
	flock($csv,LOCK_UN);
	fclose($csv);
	?>
</body>

</html>