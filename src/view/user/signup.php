
<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\header.php'; ?>
<div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
    <main>
        <div class="container">
            <h2>회원가입 페이지</h2>
            <form action="" method="post">
            <div>
                <label for="loginId">회원아이디:</label>
                <input type="text" id="loginId" name="loginId" required>
            </div>
            <div>
                <label for="loginPw">회원비밀번호:</label>
                <input type="password" id="loginPw" name="loginPw" placeholder="비밀번호를 입력하세요" required>
            </div>
            <div>
                <label for="reloginPw">회원비밀번호 확인:</label>
                <input type="password" id="reloginPw" name="reloginPw" placeholder="비밀번호를 입력하세요" required>
            </div>
            <div>
                <label for="name">성명:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="nickname">닉네임:</label>
                <input type="text" id="nickname" name="nickname" required>
            </div>
            <div>
                <label for="email">이메일:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="cellphoneNo">휴대폰:</label>
                <input type="text" id="cellphoneNo" name="cellphoneNo" required>
            </div>
            <div>
                <button type="submit">회원가입</button>
            </div>
            
            </form>
        </div>
    </main>
<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\footer.php'; ?>
