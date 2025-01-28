<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인 페이지</title>
    <link rel="stylesheet" href="../../../public\resource\index.css?v=1">
    <link rel="stylesheet" href="../../../public\resource\write.css?v=1">
</head>
<body>
<?php include '../../../public/header&footer/header.php'; ?>

    <main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
        <div class="container">
            <h2>게시판</h2>
            <form>
                <label for="postTitle">게시물 제목:</label>
                <input type="text" id="postTitle" name="postTitle" placeholder="게시물 제목을 입력하세요" required>

                <label for="postContent">내용:</label>
                <textarea id="postContent" name="postContent" placeholder="게시물 내용을 입력하세요" required rows="10"></textarea>

                <button type="submit">작성완료</button>
                <button type="button" onclick="location.href='../../../index.php'">취소</button>
            </form>
        </div>
    </main>

<?php include '../../../public/header&footer/footer.php'; ?>
</body>
</html>
