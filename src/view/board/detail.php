<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/src/app.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/src/util.php";

    if(isset($_GET['bno']) === false){
        exit;
    }
    $id = $_GET['bno'];
    $sqlQuery = "select * from article where id=?";
    

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

