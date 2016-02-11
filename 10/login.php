<?php
//1. HTML_STARTをインクルード
$title = "LOGIN"; //html_start.phpのtitleタグに表示
include("html_start.php");  //共通してるデザインはまとめて先に作り、1つのファイルを読み込むことでcssも少なくて済む
?>

<!-- login_act.php は認証処理用のPHPです。 -->
<header>
  <nav class="navbar navbar-default">ログイン</nav>
</header>
<form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="login_id" />
PW:<input type="password" name="login_pw" />
<input type="submit" value="LOGIN" />
</form>

<?php
//2. HTML_ENDをインクルード
include("html_end.php");
?>
