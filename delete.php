<?php

session_name('테스트세션'); //기본적으로 세션의 이름은 PHPSESSID 입니다.
session_start(); //세션 시작 

	require_once("./dbconfig.php");

	//$_GET['bno']이 있어야만 글삭제가 가능함.
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
?>

<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>writeboard - Forty by HTML5 UP</title>
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
				<li><a href="okindex.php">홈</a></li>
				<li><a href="write.php">글쓰기</a></li>
				<li><a href="writeboard.php">게시판</a></li>
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
						<h1>글쓰기</h1>
					</header>
					<!-- <span class="image main"><img src="images/pic11.jpg" alt="" /></span> -->
			</section>

			<article class="boardArticle">
				<h3>나의 포트폴리오</h3>
				<?php
				if (isset($bNo)) {
					$sql = 'select count(b_no) as cnt from main_data where b_id=("' . $_SESSION['id'] . '") and b_no = ' . $bNo;
					$result = $db->query($sql);
					$row = $result->fetch_assoc();
					if (empty($row['cnt'])) {
				?>
						<script>
							alert('글을 삭제할 수 없습니다.');
							history.back();
						</script>
					<?php
						exit;
					}

					$sql = 'select b_title from main_data where b_id=("' . $_SESSION['id'] . '") and b_no = ' . $bNo;
					$result = $db->query($sql);
					$row = $result->fetch_assoc();
					?>
					<div id="boardDelete">
						<form action="./delete_update.php" method="post">
							<input type="hidden" name="bno" value="<?php echo $bNo ?>">
							<table>
								<caption class="readHide">작성한 글</caption>
								<thead>
									<tr>
										<th scope="col" colspan="2"></th>
									</tr>
								</thead>
								<tbody>
									<tr class="deletebox">

										<th scope="row">글 제목</th>
										<td><?php echo $row['b_title'] ?></td>
									</tr>
									<!--<tr>
							<th scope="row"><label for="bPassword">비밀번호</label></th>
							<td><input type="password" name="bPassword" id="bPassword"></td>
						</tr>-->
								</tbody>
							</table>

							<div class="btnSet">
								<button type="submit" class="btnSubmit btn">삭제</button>
								<a href="./index.php" class="btnList btn">목록</a>
							</div>
						</form>
					</div>
				<?php
					//$bno이 없다면 삭제 실패
				} else {
				?>
					<script>
						alert('정상적인 경로를 이용해주세요.');
						history.back();
					</script>
				<?php
					exit;
				}
				?>
			</article>
			<!-- Contact
					<section id="contact">
						<div class="inner">
							<section>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" />
										</div>
										<div class="field half">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" />
										</div>
										<div class="field">
											<label for="message">Message</label>
											<textarea name="message" id="message" rows="6"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send Message" class="primary" /></li>
										<li><input type="reset" value="Clear" /></li>
									</ul>
								</form>
							</section>
							<section class="split">
								<section>
									<div class="contact-method">
										<span class="icon solid alt fa-envelope"></span>
										<h3>Email</h3>
										<a href="#">information@untitled.tld</a>
									</div>
								</section>
								<section>
									<div class="contact-method">
										<span class="icon solid alt fa-phone"></span>
										<h3>Phone</h3>
										<span>(000) 000-0000 x12387</span>
									</div>
								</section>
								<section>
									<div class="contact-method">
										<span class="icon solid alt fa-home"></span>
										<h3>Address</h3>
										<span>1234 Somewhere Road #5432<br />
										Nashville, TN 00000<br />
										United States of America</span>
									</div>
								</section>
							</section>
						</div>
					</section>

				<!-- Footer -->
			<!-- <footer id="footer">
						<div class="inner">
							<ul class="icons">
								<li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
							</ul>
							<ul class="copyright">
								<li>&copy; Untitled</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</footer>

			</div> -->

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