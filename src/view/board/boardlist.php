<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인 페이지</title>
    <link rel="stylesheet" href="../../../public\resource\index.css?v=1">
    <link rel="stylesheet" href="../../../public\resource\boardlist.css?v=1">
</head>

<body>
<?php include '../../../public/header&footer/header.php'; ?>

    <main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
        <div class="container">
            <h2>게시판 목록</h2>
        <link rel="stylesheet" href="public/resource/table.css?v=1">
        
        <table class="post-table">
            <thead>
                <tr class="table-header">
                    <th>게시물 제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                    <th>조회수</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-row">
                    <td><a href="#" class="post-link">게시물 1</a></td>
                    <td>작성자 1</td>
                    <td>2023-10-01</td>
                    <td>100</td>
                </tr>
                <tr class="table-row">
                    <td><a href="#" class="post-link">게시물 2</a></td>
                    <td>작성자 2</td>
                    <td>2023-10-02</td>
                    <td>150</td>
                </tr>
                <tr class="table-row">
                    <td><a href="#" class="post-link">게시물 3</a></td>
                    <td>작성자 3</td>
                    <td>2023-10-03</td>
                    <td>200</td>
                </tr>
            </tbody>
        </table>
        </div>
    </main>

<?php include '../../../public/header&footer/footer.php'; ?>
</body>
</html>
