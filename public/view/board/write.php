<?php
    
    try{
        $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8',"sbs" , "sbs1234");
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        if($_SERVER['REQUEST_METHOD']==="POST"){
            if($_POST['action'] === 'update'){
                $sqlQuery = "select * from article where id =:id";
                $stms = $connection->prepare($sqlQuery);
                $stms->bindValue(":id",$_POST['id'],PDO::PARAM_INT);
                $stms->execute();
                $rows = $stms->fetch(PDO::FETCH_ASSOC);
            }else if($_POST['action'] === 'save'){
                $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
                $body = filter_input(INPUT_POST,'body',FILTER_SANITIZE_STRING);
                $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
                $sqlQuery = "update article set title = :title, body = :body, updateDate = NOW() WHERE id = :id";
                $stms=$connection->prepare($sqlQuery);
                $stms ->bindValue(":title",$title);
                $stms ->bindValue(":body",$body);
                $stms ->bindValue(":id",$id);

                if($stms->execute()){
                    header("Location: boardlist.php");
                }else{
                    $errorMsg = "수정 실패. 오류";
                }
            }
        }
    }catch(PDOException $e){
        echo "write 에러=".$e->getMessage();
    }

   
?>

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
        <?php if(!empty($errorMsg)): ?>
        <h1><?php echo $errorMsg; ?></h1>
        <?php endif; ?>
        <form  method="post" class="write-form">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['id'])?>">
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" id="title" name="title" required 
                       value="<?php echo htmlspecialchars($rows['title'])?>">
            </div>
            <div class="form-group">
                <label for="body">내용</label>
                <textarea id="body" name="body" required rows="10">
                <?php echo nl2br(htmlspecialchars($rows['body'])) ?>
                </textarea>
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
