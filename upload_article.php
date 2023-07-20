<?php

session_name('테스트세션');
session_start();

	require_once("./dbconfig.php");
	$db_conn = mysqli_connect("localhost", "root", "0000", "portfolio");
   
global $bool;
$bool = false;
global $filebool;
$result = false;
$filebool = true;
global $msg;
$msg = null;
global $msgState;

if (isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") { //파일이 선택 되었다면 

    $file = $_FILES['upfile'];

    $upload_directory = 'img/';

    $ext_str = "jpg,gif,png,PNG";

    $allowed_extensions = explode(',', $ext_str);



    $max_file_size = 5242880;

    $ext = substr($file['name'], strrpos($file['name'], '.') + 1);



    // 확장자 체크

    if (!in_array($ext, $allowed_extensions)) { //확장자 배열에 해당되는게 없으면

        echo '<script>alert("업로드할 수 없는 확장자 입니다.");</script>';
        $filebool = false;


    }

    // 파일 크기 체크
    else if ($file['size'] >= $max_file_size) {

        echo '<script>alert("5MB 까지만 업로드 가능합니다.");</script>';
        $filebool = false;

    }
}else{
    $filebool = true;
}
    

// //$_POST['bno']이 있을 때만 $bno 선언
// if (isset($_POST['bno'])) {
//     $_SESSION['no'] = $_POST['bno'];
//     $bNo = $_POST['bno'];
// }
if (isset($_POST['bno'])) {
    $bNo = $_POST['bno'];

}
//bno이 없다면(글 쓰기라면) 변수 선언
if (empty($bNo)) {
    $date = date('Y-m-d H:i:s');
}

//항상 변수 선언
//$bPassword = $_POST['bPassword'];
$bTitle = $_POST['bTitle'];
$bContent = $_POST['bContent'];
$_SEEIONID = $_SESSION['id'];

//글 수정
    if (isset($bNo)) {
        $sql = 'select count(b_id) as cnt from main_data where b_id=("' . $_SESSION['id'] . '") and b_no = ' . $bNo;
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        if ($row['cnt']) {
        $sql = 'update main_data set b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_no = ' . $bNo;
        $msgState = '수정';
        $tresult = 1;
        }
         else{
        $msgState = '수정';
        $tresult = NULL;
        }



        //글 등록
    } else {
        $sql = 'insert into main_data (b_no, b_title, b_content, b_date, b_hit, b_id) values("NULL", "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $_SESSION['id'] . '")';
        $tresult = 1;
        $msgState = '등록';
    }


    if (!$filebool) { //파일실패

        $msg = '글을 ' . $msgState . '하지 못했습니다.';
        // $num = $bNo - 1;

    } else { //파일이 있거나없거나 실패한거만아니면
    $result = $db->query($sql); //글등록 쿼리

    $path = md5(microtime()) . '.' . $ext;

    if (move_uploaded_file($file['tmp_name'], $upload_directory . $path)) {

        if (isset($bNo)) {}
        else $bNo = $db->insert_id;

        $filequery = "INSERT INTO file_address (file_id, name_orig, name_save, reg_time,b_id,b_no) VALUES(?,?,?,now(),'{$_SESSION['id']}','{$bNo}')"; //글번호어떻게..저장..


        $file_id = md5(uniqid(rand(), true));

        $name_orig = $file['name'];

        $name_save = $path;


        $stmt = mysqli_prepare($db_conn, $filequery); //파일등록쿼리


        $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);

        $exec = mysqli_stmt_execute($stmt);



        mysqli_stmt_close($stmt);
    }
    }

if(!$tresult){
    $msg = '글을 수정할 수 없습니다.';

    echo '<script> alert("' . $msg . '");location.href="board.php";</script>';
} else {

    if ($result) {

        $msg = '정상적으로 글이 ' . $msgState . '되었습니다.';

        echo '<script> alert("' . $msg . '");location.href="board.php";</script>';

    } else {
        $msg = '글을 ' . $msgState . '하지 못했습니다.';
        echo '<script> alert("' . $msg . '");location.href="write.php";</script>';
    }
}
        
        


          
      
            





       