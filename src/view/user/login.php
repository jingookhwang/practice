<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" href="..\..\..\public\resource\index.css?v=1">
</head>

<body>
    <?php include '..\..\..\public\header&footer\header.php'; ?>
    <main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
    <div class="container">
        <h2>로그인 페이지</h2>
        <form>
            <label for="username">회원아이디:</label>
            <input type="text" id="username" name="username" placeholder="사용자 이름을 입력하세요" required>
            <label for="loginPw">비밀번호:</label>
            <input type="password" id="loginPw" name="loginPw" placeholder="비밀번호를 입력하세요" required>
            <button type="submit">로그인</button>
        </form>
    </div>
    </main>
    <?php include '..\..\..\public\header&footer\footer.php'; ?>
</body>

</html>