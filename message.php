<?php
session_name('테스트세션');
session_start();
$db_conn = mysqli_connect("localhost", "root", "0000", "portfolio");
if (!isset($_SESSION['id'])) {
	echo '<script>location.href="signin.php";</script>';
}
?>

<head>
<!-- <link rel="stylesheet" href="mailboxstyle.css" /> -->
			<script type="text/javascript" style > //눌르면 보이게?
				
					function test(x) {

						if (x == mymail) {
							document.getElementById('mymail').style.backgroundColor = "rgb(138, 138, 138)";
							document.getElementById('sendmail').style.backgroundColor = "gainsboro";
							document.getElementById('mymailpage').style.display = "table";
							document.getElementById('sendmailpage').style.display = "none";
						}
						if (x == sendmail) {
							document.getElementById('sendmail').style.backgroundColor = "rgb(138, 138, 138)";
							document.getElementById('mymail').style.backgroundColor = "gainsboro";
							document.getElementById('mymailpage').style.display = "none";
							document.getElementById('sendmailpage').style.display = "table";
						}

					}
				</script>

	<title>쪽지 | Eclipse Portfolio</title>
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
		<!-- <div id="main" class="alt"> -->

			<!-- One -->
			<section id="one">
				<div class="inner">
					<header class="major">
						<h1>쪽지</h1>
					</header>

					<!-- Content -->


					<!-- <hr class="major" /> -->

					<!-- message -->
					<h2 id="message"></h2>
					<div class="row gtr-200">
						
							<!DOCTYPE html>
							<html>

							<head>

								<meta charset="utf-8" />
							</head>

							<!-- <body style="margin: 0;"> -->
								<body>

								<div class="menu_display">
								
									<ul style="margin: 0;">

										<li id="mymail" onclick="test(mymail)">메일함</li>
										<li id="sendmail" onclick="test(sendmail)">보낸메일함</li>
										<li id="mailwrite" onclick="location.href='mail_send.php'">메일쓰기</li>
									</ul>
									</div>


								<div id="mymailpage" style="display: none;">
									<div class="col-6 col-12-medium">
								
										<table style="margin: 0px;">
											<colgroup>
												<col width="50px">
												<col width="400px">
												<col width="100px">
												<col width="100px">
											</colgroup>
											<?php


												$query = "SELECT Title, Text, Time, sendID FROM message_data where ID='{$_SESSION['id']}'";

												$stmt = mysqli_prepare($db_conn, $query);
												$exec = mysqli_stmt_execute($stmt);
												$result = mysqli_stmt_get_result($stmt);

											 while ($row = mysqli_fetch_assoc($result)) {

												echo "<TABLE BORDER=1 style='margin: 5px'>
												<TR>",
													"<TD>제목 : ",$row['Title'],"</TD>",
													"<TD>내용 : ",$row['Text'],"</TD>",
													"<TD>",$row['Time'],"</TD>",
													"<TD>보낸 사람 : ",$row['sendID'],"</TD>",
													"</TR>
											</TABLE>";

											 }
									?>
										</table>
									</div>
									</div>
									</div>
								

								<div id="sendmailpage" style="display: none;">
									<div class="col-6 col-12-medium">
								
										<table style="margin: 0px;">
											<colgroup>
												<col width="50px">
												<col width="400px">
												<col width="100px">
												<col width="100px">
											</colgroup>

												<?php

												$query = "SELECT Title, Text, Time, ID FROM message_data where sendID='{$_SESSION['id']}'";

												$stmt = mysqli_prepare($db_conn, $query);
												$exec = mysqli_stmt_execute($stmt);
												$result = mysqli_stmt_get_result($stmt);

											 while ($row = mysqli_fetch_assoc($result)) {

												echo "<TABLE BORDER=1 style='margin: 5px'>
												<TR>",
													"<TD>제목 : ",$row['Title'],"</TD>",
													"<TD>내용 : ",$row['Text'],"</TD>",
													"<TD>",$row['Time'],"</TD>",
													"<TD>받는 사람 : ",$row['ID'],"</TD>",
													"</TR>
											</TABLE>";

											 }
									?>
										</table>				
								</div>
								</div>
								</div>



											</section>

								
								</div>
								<!-- </div> -->

					

								<script src="assets/js/jquery.min.js"></script>
								<script src="assets/js/jquery.scrolly.min.js"></script>
								<script src="assets/js/jquery.scrollex.min.js"></script>
								<script src="assets/js/browser.min.js"></script>
								<script src="assets/js/breakpoints.min.js"></script>
								<script src="assets/js/util.js"></script>
								<script src="assets/js/main.js"></script>

							</body>

							</html>