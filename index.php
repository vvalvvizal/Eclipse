<?php
if(!session_id()){ // 세션이 실행되어 있는지 여부를 체크합니다.
	session_name('테스트세션'); //기본적으로 세션의 이름은 PHPSESSID 입니다.
	session_start(); //세션 시작 
}


date_default_timezone_set('Asia/Seoul');
require_once("./dbconfig.php");
//$_GET['bno']이 있을 때만 $bno 선언
if (isset($_GET['bno'])) {
	$bNo = $_GET['bno'];
}

if (isset($bNo)) {
	$sql = 'select b_title, b_content, b_id from main_data where b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
}
?>

<!DOCTYPE HTML>
<!--
	Solid State by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Eclipse Portfolio</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assetss/css/main.css" />
		<noscript><link rel="stylesheet" href="assetss/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="index.html">Eclipse</a><a>
							<?php 
							if(isset($_SESSION['id'])) echo " [".$_SESSION['id']."]";
							?>
							</a></h1>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<div class="inner">
							<?php
							if(isset($_SESSION['id'])){ //로그인 여부 확인 
							echo'<h2>'.$_SESSION['id'].'</h2>';
							}
							else{
								echo '<h2>Menu</h2>';
							}
							?>

							
							<ul class="links">
								<li><a href="index.php">홈</a></li>
								<li><a href="write.php">글쓰기</a></li>
								<li><a href="board.php">게시판</a></li>
								<li><a href="message.php">쪽지</a></li>
								<?php 
							if(!isset($_SESSION['id'])){
								echo'<li><a href="signin.php">로그인</a></li>';
							}
							else {
								echo'<li><a href="logout.php">로그아웃</a></li>';
							}
							?>
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<h2>Eclipse 포트폴리오 사이트에 <br>접속하신 것을 환영합니다!</h2>
							<?php
							if(!isset($_SESSION['id']))
							echo '<p>포트폴리오 사이트를 시작하고 싶으시다면 회원가입과 로그인을 진행하세요!</p>';
							else 
							echo '<p>포트폴리오를 작성하세요!</p>';
							?>
						</div>
					</section>

				<!-- Wrapper -->
					<section id="wrapper">

						<!-- One -->
							<section id="one" class="wrapper spotlight style1">
								<div class="inner">
									<a href="write.php" class="image"><img src="imagesss/pen.png" alt="" /></a>
									<div class="content">
										<h2 class="major" style="font-size: 20pt;">글쓰기</h2>
										<a href="write.php" class="special">PORTFOLIO</a>
									</div>
								</div>
							</section>

						<!-- Two -->
							<section id="two" class="wrapper alt spotlight style2">
								<div class="inner">
									<a href="board.php" class="image"><img src="imagesss/writing.png" alt="" /></a>
									<div class="content">
										<h2 class="major">게시판</h2>
										<a href="board.php" class="special">NOTICE BOARD</a>
									</div>
								</div>
							</section>

						<!-- Three -->
							<section id="three" class="wrapper spotlight style3">
								<div class="inner">
									<a href="message.php" class="image"><img src="imagesss/chat.png" alt="" /></a>
									<div class="content">
										<h2 class="major">쪽지함</h2>
										<a href="message.php" class="special">Message</a>
									</div>
								</div>
							</section>

						<!-- Four -->
							<section id="four" class="wrapper alt style1">
								<div class="inner">
									<h2 class="major">수필기업(주)</h2>
									<ul class="actions">
										<li><a href="https://heeeeeeeey.com/" class="button">찾아가기</a></li>
									</ul>
								</div>
							</section>

					</section>

				<!-- Footer -->
					<section id="footer">
						<div class="inner" style="padding-top: 0;">
							<h2 class="major">정보</h2>
							
							<ul class="contact">
								<li class="icon solid fa-home">
									동의대학교<br />
								응용소프트웨어공학과 <br />
								부산광역시 엄광로 176 산학협력관 4층 
								</li>
								<li class="icon solid fa-phone">010-2324-6629</li>
								<li class="icon solid fa-envelope"><a href="#">jgb0909890@naver.com</a></li>
							</ul>
						</div>
					</section>

			</div>

		<!-- Scripts -->
			<script src="assetss/js/jquery.min.js"></script>
			<script src="assetss/js/jquery.scrollex.min.js"></script>
			<script src="assetss/js/browser.min.js"></script>
			<script src="assetss/js/breakpoints.min.js"></script>
			<script src="assetss/js/util.js"></script>
			<script src="assetss/js/main.js"></script>

	</body>
</html>