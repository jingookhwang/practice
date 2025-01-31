<?php
    

    if(isset($_GET['bno']) === false){
        exit;
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
        $stms->bindValue(1,title);
        $stms->bindValue(2,body);


    }catch(PDOException $e){
        echo $e->getMessage();
    }
        update 게시물 준비중 pdo 세팅
    */
    

?>
<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\header.php'; ?>

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

<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\footer.php'; ?>

