<?php
session_name('테스트세션');
session_start();

if(!isset($_SESSION['id'])){
	echo'<script>location.href="signin.php";</script>';
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
	<title>메일쓰기 | Eclipse Portfolio</title>
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
				<li><a href="writeboard.php">게시판</a></li>
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
						<h1>쪽지</h1>
					</header>
          <form method="post" action="Mail_insert.php">
        
            <td>
              <input class="input" type="button" onclick="location.href='message.php'" value="쪽지함" />
            </td>
          
     
    
      <table border="0" width="850" cellspacing="1" cellpadding="5">
        <tr>
          <td><b>제목</b></td>
          <td>
            <input
              class="input2"
              type="text"
              size="100"
              maxlength="100"
              name="title"
            />
          </td>
        </tr>
        <tr>
          <td><b>받는 사람</b></td>
          <td>
            <input
              class="input2"
              type="text"
              size="100"
              maxlength="100"
              name="people"
            />
          </td>
        </tr>
		
        <tr>
          <td colspan="3" style="text-align: left;">
            <textarea
              class="input3"
              name="memo"
              rows="25"
              cols="102"
            ></textarea>
          </td>
        </tr>
      </table>
      <div class="button1">
        <table>
          <tr>
            <td>
              <input class="input" type="submit" value="보내기" />
            </td>
          </tr>
        </table>
      </div>
    </form>
					
			</div> 
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