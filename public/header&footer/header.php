<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="..\..\..\public\resource\index.css?v=3">
    <link rel="stylesheet" href="..\..\..\public\resource\write.css?v=3">
    <link rel="stylesheet" href="..\..\..\public\resource\boardlist.css?v=3">
</head>

<body>
    <header>
        <h1><a href="<?php echo $_SERVER["DOCUMENT_ROOT"].'\index.php' ?>">메인 페이지</a></h1>
        <nav>
            <a href="src\view\board\boardlist.php">게시판</a>
            <a href="src\view\user\signup.php">회원가입</a>
            <a href="src\view\user\login.php">로그인</a>
        </nav>
    </header>