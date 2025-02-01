<?php
    declare(strict_types=1);
    namespace board\detail;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util.php';
    use app\Application;
    use app\util;
    use app\util\DB;

    if(isset($_GET['bno']) === false){
        exit;
    }
    $param = ["id" => $_GET['bno']];
    $sqlQuery = "select * from article where id=:id";
    $DB = new DB();
    try{
        $detail = $DB->handleRequest("GET",$sqlQuery,$param);
    }catch(\PDOException $e){
        echo $e->getMessage();
    }
    


?>

<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\header.php'; ?>

    <main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
        <div class="container">
            <h2>게시판</h2>
            <form>
                <?php foreach($detail as $row):?>
                <label for="postTitle">게시물 번호:<?php echo htmlspecialchars($row['id'])  ?></label>
                <label for="postTitle">게시물 제목:</label>
                <input type="text" id="postTitle" name="postTitle" value="<?php echo htmlspecialchars($row['title']) ?>" required>
                <label for="postContent">내용:</label>
                <textarea id="postContent" name="postContent" required><?php echo htmlspecialchars($row['body'])?></textarea>
                <?php endforeach;?>
                <button type="submit" name="deatil_submit_button" onclick="location.reload='../../../index.php'">변경하기</button>
                <button type="button" name="deatil_cancel_button" onclick="location.reload='../../../index.php'">취소</button>
            </form>
        </div>
    </main>

<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\footer.php'; ?>


<script>
const textarea = document.getElementById('postContent'); // textarea 요소의 ID를 가정

textarea.addEventListener('keydown', function(event) {
  if ((event.ctrlKey || event.metaKey) && event.key === 's') { // Ctrl 또는 Cmd 키와 S 키를 눌렀는지 확인
    event.preventDefault(); // 브라우저의 기본 저장 동작 취소
    alert('Ctrl+S 저장이 막혔습니다!'); // (선택 사항) 사용자에게 알림 메시지 표시
    // 여기에 원하는 다른 동작을 추가할 수 있습니다 (예: 자동 저장 기능 호출)
  }
});</script>

