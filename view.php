<?php
session_name('테스트세션'); //기본적으로 세션의 이름은 PHPSESSID 입니다.
session_start(); //세션 시작 




$db_conn = mysqli_connect("localhost", "root", "0000", "portfolio");
											
if (!isset($_SESSION['id'])) {
	echo '<script>location.href="signin.php";</script>'; //로그인되어있지 않으면 로그인 페이지로 이동 
}

require_once("./dbconfig.php");
$bNo = $_GET['bno'];



if (!empty($bNo) && empty($_COOKIE['main_data' . $bNo])) {
	$sql = 'update main_data set b_hit = b_hit + 1  where b_id=("' . $_SESSION['id'] . '") and b_no = ' . $bNo;
	$result = $db->query($sql);
	if (empty($result)) {
?>
		<script>
			alert('오류가 발생했습니다.');
			history.back();
		</script>
<?php
	} else {
		setcookie('main_data' . $bNo, TRUE, time() + (60 * 60 * 24), '/');
	}
}

$sql = 'select b_title, b_content, b_date, b_hit, b_id from main_data where b_id=("' . $_SESSION['id'] . '") and b_no = ' . $bNo;
$result = $db->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Eclipse Portfolio</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header" class="alt">
			<a href="index.php" class="logo"><strong>ECLIPSE</strong> <span>by DEU</span></a>
			<nav>
				<a href="#menu">메뉴</a>
			</nav>
		</header>

		<!-- Menu -->
		<nav id="menu">
			<ul class="links">
				<li><a href="index.php">홈</a></li>
				<li><a href="write.php">글쓰기</a></li>
				<li><a href="board.php">게시판</a></li>
				<li><a href="message.php">쪽지</a></li>
			</ul>
			<ul class="actions stacked">
				<!-- <li><a href="#" class="button primary fit">작성 시작</a></li> -->
				<li><a href="signin.php" class="button fit">로그아웃</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main" class="alt">
			<!-- One -->
			<section id="one">
				<div class="inner">
					<header class="major">
						<h1>작성한 글</h1>
					</header>

					<!-- Content -->


					<!-- <hr class="major" /> -->

					<!-- message -->
					<h2 id="message"></h2>
					<div class="row gtr-200">
						<div class="col-6 col-12-medium">


							<article class="boardArticle">
								<h3></h3>
								<!-- <div id="boardView"> -->




									<h3 id="boardTitle"><?php echo $row['b_title'] ?></h3>

									<div id="boardContent"><?php echo $row['b_content'] ?></div>
									<?php

									$db_conn = mysqli_connect("localhost", "root", "0000", "portfolio");
											
 									
									//해당 아이디가 올린 모든 파일이 뜸 
									$query = "SELECT file_id, name_orig, name_save FROM file_address where b_id='{$_SESSION['id']}' and b_no=$bNo ORDER BY reg_time DESC";

									$stmt = mysqli_prepare($db_conn, $query);
									$exec = mysqli_stmt_execute($stmt);
									$resultfile = mysqli_stmt_get_result($stmt);
									while ($rowfile = mysqli_fetch_assoc($resultfile)) {
									?>
										<tr>
											
											<td><img src = "/img/<?php echo $rowfile['name_save'] ?>"></a></td>

										</tr>
									
									<?php
									}
									?>
									<div id="boardInfo">
										<!--<span id="boardID">작성자: <?php echo $row['b_id'] ?></span>-->
										<span id="boardDate">작성일: <?php echo $row['b_date'] ?></span>
										<span id="boardHit">조회: <?php echo $row['b_hit'] ?></span>
									</div>


									<div class="btnSet">
										<a href="./write.php?bno=<?php echo $bNo ?>">수정</a>
										<a href="./delete.php?bno=<?php echo $bNo ?>">삭제</a>
										<a href="./writeboard.php">목록</a>
									</div>
							
								<!-- </div> -->
							</article>
							</div>
							</div>
							</div>
							</section>
							</div>
							</div>
							
							

						<!-- Scripts -->
						<script src="assets/js/jquery.min.js"></script>
						<script src="assets/js/jquery.scrolly.min.js"></script>
						<script src="assets/js/jquery.scrollex.min.js"></script>
						<script src="assets/js/browser.min.js"></script>
						<script src="assets/js/breakpoints.min.js"></script>
						<script src="assets/js/util.js"></script>
						<script src="assets/js/main.js"></script>

</body>

</html>