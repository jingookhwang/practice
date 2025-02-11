

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/view/css/detail.css">
    <title>게시글 상세</title>
</head>
<?php include __DIR__ . '/../../view/layout/header.php'; ?>
<body>
    <div class="container">
        <h1>게시글 상세</h1>
        <div class="article-detail">
            <div class="article-header">
                <h2>db제목</h2>
                <div class="article-info">
                    <span>작성일: db작성일</span>
                </div>
            </div>
            <div class="article-content">
                db바디
            </div>
            <div class="article-actions">
                <a href="/board/list.php" class="btn">목록으로</a>
                <a href="?>" class="btn">수정</a>
                <button onclick="" class="btn btn-danger">삭제</button>
            </div>
        </div>
    </div>
    <script>
    function deleteArticle(id) {
        if (confirm('정말 삭제하시겠습니까?')) {
            location.href = `/board/delete.php?id=${id}`;
        }
    }
    </script>
<?php include __DIR__ . '/../../view/layout/footer.php'; ?>    
</body>
</html>
