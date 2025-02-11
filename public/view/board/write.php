

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/view/css/write.css">
    <title></title>
</head>
<?php include __DIR__ . '/../../view/layout/header.php'; ?>
<body>
    <div class="container">
        <h1></h1>
        <form action="/board/process.php" method="post" class="write-form">
            <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>">
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" id="title" name="title" required 
                       value="">
            </div>
            <div class="form-group">
                <label for="body">내용</label>
                <textarea id="body" name="body" required rows="10"></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">저장</button>
                <a href="/board/list.php" class="btn">취소</a>
            </div>
        </form>
    </div>
    <?php include __DIR__ . '/../../view/layout/footer.php'; ?>    
</body>
</html>
