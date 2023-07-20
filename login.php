<?php
 $db_host = "localhost";
 $db_user = "root";
 $db_passwd = "0000";
 
 $conn = mysqli_connect($db_host,$db_user,$db_passwd);

if(!$conn) exit;

$db = mysqli_select_db($conn, 'account');

if(!$db) exit;

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
		
if($_POST["fname"] == "" || $_POST["lname"] == "" )//둘중 하나라도 입력되지 않은 상태라면.
{
    echo '<script> alert("아이디나 패스워드를 입력하세요."); history.back();</script>';
}
else
{
    //둘다 정확하게 입력한 상태라면.
    //id : fname pw : lname
    $user_id = $_POST['fname'];
    $user_pw = $_POST['lname'];
    //login_register.html에 post로 받아온 아이디와 비밀번호 저장.
    $sql = "SELECT * FROM info WHERE ID = '$user_id' AND PW = '$user_pw'";
    $result = mysqli_query($conn,$sql);

    if ($result) 
    {
        $count = mysqli_num_rows($result);

        if($count == 1)
        {
            if(!session_id()){ // 세션이 실행되어 있는지 여부를 체크합니다.
                session_name('테스트세션'); //기본적으로 세션의 이름은 PHPSESSID 입니다.
                session_start(); //세션 시작 
            }
            $_SESSION['id'] = $user_id;
            session_write_close();
            
            echo '<script> alert("로그인 성공!");location.href="index.php";</script>';

        }
        else
        {
            echo '<script> alert("로그인 실패. 아이디와 패스워드를 확인해주세요."); history.back();</script>';
        }
    } 
    else 
    {
        echo "오류가 발생했습니다.<br>";
        echo mysqli_error($conn);
    }
}
