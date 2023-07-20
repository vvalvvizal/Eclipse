<?php
	require_once("./dbconfig.php");

	session_name('테스트세션');
    session_start();

	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}

	//$bPassword = $_POST['bPassword'];

//글 삭제
if(isset($bNo)) {
	//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(b_id) as cnt from main_data where b_id=("' . $_SESSION['id'] . '") and b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	//비밀번호가 맞다면 삭제 쿼리 작성
	if($row['cnt']) {
		$sql = 'delete from main_data where b_id=("' . $_SESSION['id'] . '") and b_no = ' . $bNo;//메인데이터 지우기 
		// $sql2 = 'delete from file_address where b_id=("' . $_SESSION['id'] . '") and b_no = ' . $bNo;//파일도 삭제해야지
	 //틀리다면 메시지 출력 후 이전화면으로
	 } else {
		$msg = '삭제할 수 없습니다.';
	?>
	<script>
		alert("<?php echo $msg?>");
		history.back();
	 </script>
	<?php
	exit;
	}
}

$result = $db->query($sql);	
// $result2 = $db->query($sql2);	
//쿼리가 정상 실행 됐다면,
if($result) {
	$msg = '정상적으로 글이 삭제되었습니다.';
	$replaceURL = './writeboard.php';
} else {
	$msg = '글을 삭제하지 못했습니다.';
?>
	<script>
		alert("<?php echo $msg?>");
		history.back();
	</script>
<?php
	exit;
}


?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>