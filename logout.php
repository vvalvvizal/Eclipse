<?php
	session_name('테스트세션'); //기본적으로 세션의 이름은 PHPSESSID 입니다.
	session_start(); //세션 시작 

    if(isset($_SESSION['id'])) unset($_SESSION['id']);

    echo '<script>location.href="index.php";</script>';
?>