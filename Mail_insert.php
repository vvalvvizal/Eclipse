<?php
require_once("./dbconfig.php");
session_name('테스트세션'); //기본적으로 세션의 이름은 PHPSESSID 입니다.
session_start(); //세션 시작 


if(!isset($_SESSION['id'])){
	echo'<script>location.href="signin.php";</script>';
   }


$db_host = "localhost";
$db_user = "root";
$db_passwd = "0000";

$conn = mysqli_connect($db_host, $db_user, $db_passwd);
$conns = mysqli_connect($db_host, $db_user, $db_passwd);

if (!$conn)
    exit;

$db = mysqli_select_db($conn, 'portfolio');
$db_search = mysqli_select_db($conns, 'account');

if (!$db)
    exit;

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

$title = $_POST['title'];
$text = $_POST['memo'];
$people = $_POST['people'];
$sendID = $_SESSION['id'];
$time = date("Y-m-d H:i");

$sql = "SELECT * FROM info WHERE  ID = '$people'"; //아이디 조회 쿼리 
$result = mysqli_query($conns,$sql);
$row = mysqli_num_rows($result);

if($result){
if(!$row) echo '<script>alert("해당 ID가 존재하지 않습니다");history.back();</script>'; //알림문구 출력
else{ //중복되지 않는다면 
    $sql = "insert into message_data values('$title','$text','$time','$people','$sendID')";


    mysqli_query($conn, $sql);

    header("Location: message.php");
}
}


if (is_resource($conn)) {
    mysqli_close($conn);
}
?>