<?php
    try {
        $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8',"sbs" , "sbs1234");
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // DB 연결 실패 시, 상세 에러는 로그 처리 후 종료
        error_log("DB 연결 실패: " . $e->getMessage());
        echo "서버 내부 오류가 발생했습니다.";
        exit;
    }

    $errorMsg="";
    $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
    $body = filter_input(INPUT_POST,'body',FILTER_SANITIZE_STRING);
    
    if($_SERVER['REQUEST_METHOD'] === "POST" and isset($_POST) and $_POST['action']==="write"){
        if(!empty($title) and !empty($body)){
            $sqlQuery = "INSERT INTO article (title, body, regDate, updateDate) VALUES (:title, :body, NOW(), NOW())";
            $stms=$connection->prepare($sqlQuery);
            $stms->bindValue(":title",$title,PDO::PARAM_STR);
            $stms->bindValue(":body",$body,PDO::PARAM_STR);
            $stms->execute();
            $count = $stms->rowCount();
            
            if($count > 0){
                header("Location: /index.php");
                exit;
            }else{
                $errorMsg="글쓰기 실패";
            }
        }
        
    }
    // else{
    //     echo "<script>alert('잘못된 접근방식입니다.'); history.back();</script>";
    // }


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>게시글 작성</title>
    <link rel="stylesheet" href="/view/css/write.css">
</head>
<?php include __DIR__ . '/../../view/layout/header.php'; ?>
<body>
    <div class="container">
       <?php if(!empty($errorMsg)):?>
        <div class="error"><?php echo htmlspecialchars($errorMsg)?></div>
       <?php endif;?> 
        <form  method="post" class="write-form">
            <input type="hidden" name="action" value="write"> 
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" id="title" name="title" required >
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