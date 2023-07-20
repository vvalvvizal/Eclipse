<?php
session_name('테스트세션'); //기본적으로 세션의 이름은 PHPSESSID 입니다.
session_start(); //세션 시작 

if(!isset($_SESSION['id'])){
	echo'<script>location.href="signin.php";</script>';
   }

date_default_timezone_set('Asia/Seoul');
require_once("./dbconfig.php");

/* 페이징 시작 */
//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

//cnt는 게시글수 담는 필드
//main_data는 테이블 이름

$sql = 'select count(*) as cnt from main_data where b_id=("' . $_SESSION['id'] . '")';
$result = $db->query($sql);
$row = $result->fetch_assoc();

$allPost = $row['cnt']; //전체 게시글의 수

$onePage = 15; // 한 페이지에 보여줄 게시글의 수.
$allPage = ceil($allPost / $onePage); //전체 페이지의 수

if ($page < 1 && $page > $allPage) {
?>
	<script>
		alert("존재하지 않는 페이지입니다.");
		history.back();
	</script>
<?php
	exit;
}



$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
$currentSection = ceil($page / $oneSection); //현재 섹션
$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

if ($currentSection == $allSection) {
	$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
} else {
	$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
}

$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

$paging = '<ul>'; // 페이징을 저장할 변수

//첫 페이지가 아니라면 처음 버튼을 생성
if ($page != 1) {
	$paging .= '<li class="page page_start"><a href="./writeboard.php?page=1">처음</a></li>';
}
//첫 섹션이 아니라면 이전 버튼을 생성
if ($currentSection != 1) {
	$paging .= '<li class="page page_prev"><a href="./writeboard.php?page=' . $prevPage . '">이전</a></li>';
}

for ($i = $firstPage; $i <= $lastPage; $i++) {
	if ($i == $page) {
		$paging .= '<li class="page current">' . $i . '</li>';
	} else {
		$paging .= '<li class="page"><a href="./writeboard.php?page=' . $i . '">' . $i . '</a></li>';
	}
}

//마지막 섹션이 아니라면 다음 버튼을 생성
if ($currentSection != $allSection) {
	$paging .= '<li class="page page_next"><a href="./writeboard.php?page=' . $nextPage . '">다음</a></li>';
}

//마지막 페이지가 아니라면 끝 버튼을 생성
if ($page != $allPage) {
	$paging .= '<li class="page page_end"><a href="./writeboard.php?page=' . $allPage . '">끝</a></li>';
}
$paging .= '</ul>';

/* 페이징 끝 */


$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

$sql = 'select * from main_data where b_id=("' . $_SESSION['id'] . '") order by b_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
$result = $db->query($sql);
?>



<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>게시물 | Eclipse Portfolio</title>
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
			<?php
				if(isset($_SESSION['id'])){
				echo'<li><a href="#" class="button primary fit">'.$_SESSION['id'].'</a></li>';
				}
				?>
				<!-- <li><a href="#" class="button primary fit">작성 시작</a></li> -->
				<li><a href="logout.php" class="button fit">로그아웃</a></li>
			</ul>
		</nav>



		<!-- Main -->
		<div id="main" class="alt">

		
			<!-- One -->
			<section id="banner" class="major">
			<div class="inner">
				<h1>
				<input type="button" onclick="location.href='writeboard.php'" value="내 게시판">
				&nbsp;&nbsp;&nbsp;
				<input type="button" onclick="location.href='mainwriteboard.php'" value="공용게시판">
				</h1>
			</div>
		</section>
		</div>

		
			

		<!-- Contact-->
						<!--
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