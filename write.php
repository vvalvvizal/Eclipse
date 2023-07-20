<?php

session_name('테스트세션'); //기본적으로 세션의 이름은 PHPSESSID 입니다.
session_start(); //세션 시작 


if (!isset($_SESSION['id'])) {
	echo '<script>location.href="signin.php";</script>'; //로그인되어있지 않으면 로그인 페이지로 이동 
}

require_once("./dbconfig.php");
date_default_timezone_set('Asia/Seoul');
//$_GET['bno']이 있을 때만 $bno 선언
if (isset($_GET['bno'])) {
	$bNo = $_GET['bno'];
	$_SESSION['no'] = $bNo;
}
else{
	$sql = 'SELECT max(b_no) from main_data';
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$_SESSION['no'] = $row['max(b_no)']+1;
}


if (isset($bNo)) {
	$sql = 'select b_title, b_content, b_id from main_data where b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
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
<title>글쓰기 | Eclipse Portfolio</title>
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
				if (isset($_SESSION['id'])) { //로그인되어있다면 아이디 표시 
					echo '<li><a href="#" class="button primary fit">' . $_SESSION['id'] . '</a></li>';
				}
				?>
				<!-- <li><a href="#" class="button primary fit">작성 시작</a></li> -->
				<li><a href="logout.php" class="button fit">로그아웃</a></li>
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
					<!-- <script>


						function twosend($e) {
							if($e=="form2"){
							document.form2.action = 'uploadserver.php';
							// document.form2.target =  'write_update.php';
							
						}
							if($e=="form1"){
							document.form1.action = 'write_update.php';
							// document.form1.target =  'write_update.php';
							
						}
						
				

						}
					</script> -->
					<script>
						function submit2(frm) {
							frm.action = 'uploadserver.php';
							frm.submit();
							frm.target = "_top";
							return true;
						}
					</script>


					<!--<form name="form2" id="form2" method="post"enctype="multipart/form-data" action="write_update.php" >-->
					<form name="form2" id="form2" method="post"enctype="multipart/form-data" action="upload_article.php" >
						<!-- <form action="./write_update.php" method="post"> -->
						<?php
						if (isset($bNo)){ //수정하는 경우
							echo '<input type="hidden" name="bno" value="' . $bNo . '">';
						}
						?>
						<table id="boardWrite">
							<caption class="readHide"></caption>
							<tbody>
								<tr>
									<!--<th scope="row"><label for="bID">아이디</label></th>
							 <td class="id">
								 <?php
									// if(isset($bNo)) {
									// echo $row['b_id'];//이 아이디 칼럼
									// } else { 
									?>
									<!-- <input type="text" name="bID" id="bID">-->
									<?php //} 
									?>
									</td>
								</tr>
								<tr>
									<!--<th scope="row"><label for="bPassword">비밀번호</label></th>
							<td class="password"><input type="password" name="bPassword" id="bPassword"></td>-->
								</tr>
								<tr>
									<th scope="row"><label for="bTitle">제목</label></th>
									<td class="title"><input type="text" name="bTitle" id="bTitle" value="<?php echo isset($row['b_title']) ? $row['b_title'] : null ?>"></td>
								</tr>
								<tr>
									<th scope="row"><label for="bContent">내용</label></th>
									<td class="content"><textarea name="bContent" id="bContent"><?php echo isset($row['b_content']) ? $row['b_content'] : null ?></textarea></td>
								</tr>
								<tr>
									<td>
										<label for="upfile">첨부파일</label>
										<!--파일-->
										<script type="text/javascript">
											// 업로드 할 수 있는 파일 확장자를 제한합니다.

											var extArray = new Array('jpg', 'gif', 'png', 'PNG');

											var path = document.getElementById("upfile").value;

											if (path == "") {
												alert("파일을 선택해 주세요.");
												return false;
											}
											var pos = path.indexOf(".");
											if (pos < 0) {
												alert("확장자가 없는 파일 입니다.");
												return false;
												
											}
											var ext = path.slice(path.indexOf(".") + 1).toLowerCase();
											var checkExt = false;
											for (var i = 0; i < extArray.length; i++) {
												if (ext == extArray[i]) {
													checkExt = true;
													break;
												}
											}
											if (checkExt == false) {
												alert("업로드 할 수 없는 파일 확장자 입니다.");
												return false;
											}
											return true;
										</script>
									</td>
									<td>
									 <!--<form name="form1" id="form1" method="post" enctype="multipart/form-data" onsubmit ='return submit2(this.form);-->
											<input type="file" name="upfile" id="upfile" />
											<!-- <input value="업로드" type="submit"> -->
									<!-- </form> -->
									</td>

								</tr>
							</tbody>
						</table>
							<div class="btnSet">
								<button type ="submit" class="btnSubmit btn">
									<?php echo isset($bNo) ? '수정' : '작성' ?>
								</button>
							</div>
					</form>
					<a href="./writeboard.php" class="btnList btn">목록</a>
				</div>


		</div>
		</section>

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