<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>회원가입 | Eclipse Portfolio</title>
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
		<!-- Note: The "styleN" class below should match that of the banner element. -->
		<header id="header" class="alt style2">
			<a href="index.php" class="logo"><strong>ECLIPSE</strong> <span>by DEU</span></a>
			<nav>
				<a href="#menu">Menu</a>
			</nav>
		</header>

		<!-- Menu -->
		<!-- <nav id="menu">
			<ul class="links">
				<li><a href="index.php">Home</a></li>
				<li><a href="landing.php">Landing</a></li>
				<li><a href="generic.php">Generic</a></li>
				<li><a href="message.php">message</a></li>
			</ul>
			<ul class="actions stacked">
				<li><a href="#" class="button primary fit">Get Started</a></li>
				<li><a href="#" class="button fit">Log In</a></li>
			</ul>
		</nav> -->

		<!-- Banner -->
		<!-- Note: The "styleN" class below should match that of the header element. -->
		<section id="banner" class="style2">
			<div class="inner">
				<span class="image">
					<img src="images/pic07.jpg" alt="" />
				</span>
				<header class="major">
					<h1>환영합니다 회원가입 화면입니다</h1>
				</header>
				<div class="content">
					<p>Lorem ipsum dolor sit amet nullam consequat<br />
						sed veroeros. tempus adipiscing nulla.</p>
				</div>
			</div>
		</section>

		<!-- Main -->
		<div id="main">

			<!-- One -->
			<section id="one">
				<div class="inner">
					<header class="major">
						<h2>회원가입</h2>
					</header>

					<script type="text/javascript">
						var IdEn = false;
						var PwEn = false;
						var NameEn = false;
						var BirthEn = false;
						var PhonenumEn = false;
						var EmailEn = false;

						function test() {
							var p1 = document.getElementById('pw').value;
							var p2 = document.getElementById('pwCheck').value;

							if (p1.length < 6) {
								alert('입력한 글자가 6글자 이상이어야 합니다.');
								return false;
							}

							if (p1 != p2) {
								document.getElementById('fail').style.display = "table-cell";
								document.getElementById('sucess').style.display = "none";
								return false;
							} else {
								document.getElementById('sucess').style.display = "table-cell";
								document.getElementById('fail').style.display = "none";
								PwEn = true;
								return true;
							}
						}

						function Resubmit() {
							var id = document.getElementById('Idd').value;
							var name = document.getElementById('namee').value;
							var Phone = document.getElementById('p1').value + document.getElementById('p2').value +
								document.getElementById('p3').value;
							var Email = document.getElementById('email').value;
							var birth = document.getElementById('birth1').value + document.getElementById('birth2').value +
								document.getElementById('birth3').value;

							if (id != "") IdEn = true;
							else {
								alert('ID를 입력하세요');
								return false;
							}
							if (name != "") NameEn = true;
							else {
								alert('이름을 입력하세요');
								return false;
							}
							if (birth != "") BirthEn = true;
							else {
								alert('생년월일을 입력하세요');
								return false;
							}
							if (Phone.length >= 10) PhonenumEn = true;
							else {
								alert('전화번호를 입력하세요');
								return false;
							}
							if (email != "") EmailEn = true;
							else {
								alert('이메일을 입력하세요');
								return false;
							}

							if (IdEn == true && PwEn == true && NameEn == true && BirthEn == true && PhonenumEn == true && EmailEn == true) return true;
							else {
								alert('정보가 제대로 입력되지 않았습니다.');
								return false;
							}
						}

						function birthcheck(x) {
							var p2 = document.getElementById('p2').value;
							var p3 = document.getElementById('p3').value;

							p2 = number(p2);

						}
					</script>
					</head>

					<body style="background-color: rgb(226, 221, 221);">
						<form method="post" action="Account_insert.php" id="register" onsubmit="return Resubmit()">
							<center>
								<table cellspacing=1 cellpadding=3 id="login">
									<tr>

									</tr>
									<tr>
										<td colspan="2" class="word">아이디
									</tr>
									<tr>
										<td colspan="2">
											<input class="insertbord" id="Idd" type="text" size=10 maxlength=15 name="id" pattern="^([a-z0-9]){6,15}$">
										</td>
									</tr>
									<tr>
										<td colspan="2" class="word">비밀번호
									</tr>
									<tr>
										<td colspan="2">
											<input class="insertbord" type="text" size=8 maxlength=20 name="pw" id="pw">
										</td>
									</tr>
									<tr>
										<td colspan="2" class="word">비밀번호확인
											<button type="button" onclick="test()">확인</button>
										<td>
									</tr>
									<tr>
										<td colspan="2">
											<input class="insertbord" type="password" size=8 maxlength=20 name="pwCheck" id="pwCheck">
										</td>
									</tr>
									<tr>
										<td colspan="1" style="display: none;" id="fail">*비밀번호가 일치하지않습니다*</td>
									</tr>
									<tr>
										<td colspan="2" style="display: none" id="sucess">*비밀번호가 일치하였습니다*</td>
									</tr>
									<tr>
										<td colspan="2" class="word">이름 </td>
									</tr>
									<tr>
										<td colspan="2">
											<input id="namee" class="insertbord" type="text" size=10 maxlength=10 name="name" pattern="^[ㄱ-힣]+$">
										</td>
									</tr>
									<tr>
										<td colspan="2" class="word">생년월일 :
											<input id="birth1" type="text" size=4 maxlength=4 name="birth1" pattern="[0-9]{4}">년
											<input id="birth3" type="text" size=2 maxlength=2 name="birth2" pattern="[0-9]{2}">월
											<input id="birth2" type="text" size=2 maxlength=2 name="birth3" pattern="[0-9]{2}">일
										</td>
									</tr>
									<tr>
										<td colspan="2" class="word">
											전화번호 : <select id="p1" name="p1">
												<option value=" "> 선택 </option>
												<option value="010"> 010 </option>
												<option value="011"> 011 </option>
												<option value="016"> 016 </option>
												<option value="017"> 017 </option>
												<option value="019"> 019 </option>
											</select> -
											<input id="p2" type="text" size=4 name="p2" maxlength=4 pattern="[0-9]{4}"> -
											<input id="p3" type="text" size=4 name="p3" maxlength=4 pattern="[0-9]{4}">
										</td>
									</tr>
									<tr>
										<td id="email" colspan="2" class="word" style="padding-bottom: 50px;">이메일 : <input type="text" size=30 maxlength=30 name="email" pattern="^(?=.*[a-zA-Z])((?=.*\d)|(?=.*\W))(?=.*[!@#$%^*+=-]).{6,30}$"></td>
									</tr>
									<tr>
										<td class="register">
											<input type="submit" value="확인" class="register">
										</td>
										<td class="reset">
											<input type="button" onclick="location.href='signin.php'" value=" 취소 " class="cancle">
										</td>
									</tr>
								</table>
							</center>
						</form>
						</table>
						<p>Nullam et orci eu lorem consequat tincidunt vivamus et sagittis magna sed nunc rhoncus condimentum sem. In efficitur ligula tate urna. Maecenas massa vel lacinia pellentesque lorem ipsum dolor. Nullam et orci eu lorem consequat tincidunt. Vivamus et sagittis libero. Nullam et orci eu lorem consequat tincidunt vivamus et sagittis magna sed nunc rhoncus condimentum sem. In efficitur ligula tate urna.</p>
				</div>
			</section>


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