<?php
 $db_host = "localhost";
 $db_user = "root";
 $db_passwd = "0000";
 
 $conn = mysqli_connect($db_host,$db_user,$db_passwd);

if(!$conn) exit;

$db = mysqli_select_db($conn, 'account');

if(!$db)exit;

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
		
$id = $_POST['id'];
$pw = $_POST['pw'];
$pwcheck = $_POST['pwCheck'];

if($pw != $pwcheck) header("Location: writeboard.php");

$sql = "SELECT * FROM info WHERE  ID = '$id'"; //아이디 중복  조회 쿼리 
$result = mysqli_query($conn,$sql);
$row = mysqli_num_rows($result);

if($result){
if($row >= 1) echo '<script>alert("ID 중복입니다");history.back();</script>'; //알림문구 출력
else{ //중복되지 않는다면 
$birth = "{$_POST['birth1']}{$_POST['birth2']}{$_POST['birth3']}";
$phone = "{$_POST['p1']}{$_POST['p2']}{$_POST['p3']}";
$name = $_POST['name'];
$email = $_POST['email'];

$sql = "insert into info values('$id','$pw','$birth','$name','$email','$phone')"; //db에 정보 등록 

mysqli_query($conn, $sql);

header("Location: signin.php");//로그인 페이지로 이동
}
}
if(is_resource($conn)){
    mysqli_close($conn);
}
?>