<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/view/css/header.css">
    <link rel="stylesheet" href="/view/css/boardlist.css">
    <link rel="stylesheet" href="/view/css/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <a href="/" class="logo">MY BOARD</a>
            <ul class="nav-menu">
                <li><a href="/index.php">홈</a></li>
                <li><a href="/view/board/boardlist.php">게시판</a></li>

                <?php if(!isset($_SESSION['email'])):?>
                <li><a href="/view/user/login.php">로그인</a></li>
                <li><a href="#">회원가입</a></li>
                <?php else: ?>
                <li><a><?php echo htmlspecialchars($_SESSION['email']); ?></a></li>
                <li><a href="/view/user/loginout.php">로그아웃</a></li>
                <?php endif; ?>    

            </ul>
        </div>
    </header>
