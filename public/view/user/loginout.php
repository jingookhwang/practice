<?php
session_start();  // 세션 시작

// 세션 데이터 삭제
session_unset();

// 세션 파기
session_destroy();

// 세션 쿠키 삭제
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// 홈페이지로 리다이렉트
header('Location: /index.php');
exit;
?>