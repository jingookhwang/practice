<?php
    //굳이 필요는 없는데. 혹시나해서. 원래는 session에 아이디 매칭 시키고 없으면 버튼안보이게해야해.
    //지금은 수정할 수 있게 모두다 세팅..
    
    if(isset($_GET) and $_SERVER['REQUEST_METHOD']==="GET"){
        $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8',"sbs" , "sbs1234");
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sqlQuery = "select * from article where id =:id";
        $stms = $connection->prepare($sqlQuery);
        $stms->bindValue(":id",$_GET['id'],PDO::PARAM_INT);
        $stms->execute();
        $rows = $stms->fetch(PDO::FETCH_ASSOC);
    }

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/view/css/detail.css">
    <title>게시글 상세</title>
</head>
<?php include __DIR__ . '/../../view/layout/header.php'; ?>
<body>
    <form method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['id']); ?>"> 
    <input type="hidden" name="action" value="update">   
    <div class="container">
        <h1>게시글 상세</h1>
        <?php if(isset($rows)):?>
        <div class="article-detail">
            <div class="article-header">
                <h2><?php echo htmlspecialchars($rows['title']) ?></h2>
                <div class="article-info">
                    <span>작성일: <?php echo htmlspecialchars($rows['updateDate'])?></span>
                </div>
            </div>
            <div class="article-content">
                <?php echo nl2br(htmlspecialchars($rows['body']))?>
            </div>
            
            <div class="article-actions">
                <a href="boardlist.php" class="btn">목록으로</a>
                <button type="submit" formaction="update.php" class="btn">수정</button>
                <button onclick="deleteArticle(<?php echo htmlspecialchars($rows['id']); ?>)" class="btn btn-danger">삭제</button>
            </div>
        </div> 
        <?php endif; ?>
    </div>
    </form>
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
