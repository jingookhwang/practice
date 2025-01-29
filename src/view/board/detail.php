<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인 페이지</title>
    <link rel="stylesheet" href="../../../public\resource\index.css?v=1">
    <link rel="stylesheet" href="../../../public\resource\write.css?v=1">
</head>

<?php
    

    if(isset($_GET['bno']) === false){
        exit;
    }

    $id = intval($_GET['bno']);
    $connection = mysqli_connect("127.0.0.1","sbs","sbs1234","myproject");//연결
    $sqlQuery = "SELECT * FROM article WHERE ID = ?";
    $stmt = mysqli_prepare($connection,$sqlQuery); //쿼리 준비
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);//쿼리 실행

    $result = mysqli_stmt_get_result($stmt);
    if(!$result){
        exit;
        mysqli_close($connection);
    }    

    /*
    $dbHost = '127.0.0.1';//에러가 안뜸
    $dbName = 'myproject';
    $dbUser = 'sbs';
    $dbPass = 'sbs1234';

    try{
        $connection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8",$dbUser,$dbPass);
        $connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sqlQuery = "update article 
                        set title      = ?,
                            body       = ?,
                            updateDate = now()
                     where id=?";
        $stms->bindValue(1,);


    }catch(PDOException $e){
        echo $e->getMessage();
    }
        update 게시물 준비중 pdo 세팅
    */
    

?>
<body>
<?php include '../../../public/header&footer/header.php'; ?>

    <main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
        <div class="container">
            <h2>게시판</h2>
            <form>
                <?php
                    if(mysqli_num_rows($result) === 0){
                        echo "<script>alert('게시물이 없습니다.');</script>";
                    }else{
                        $row = mysqli_fetch_assoc($result); ?>
                
                <label for="postTitle">게시물 번호:<?php echo htmlspecialchars($row['id'])?></label>

                <label for="postTitle">게시물 제목:</label>
                <input type="text" id="postTitle" name="postTitle" value="<?php echo htmlspecialchars($row['title']) ?>">

                <label for="postContent">내용:</label>
                <textarea id="postContent" name="postContent"><?php echo htmlspecialchars($row['body']) ?></textarea>
            <?php } ?>
                <button type="submit">변경하기</button>
                <button type="button" onclick="location.href='../../../index.php'">취소</button>
            </form>
        </div>
    </main>

<?php include '../../../public/header&footer/footer.php'; ?>
</body>
</html>
