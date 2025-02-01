<?php
    declare(strict_types=1);
    namespace board\detail;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util.php';
    use app\Application;
    use app\util;
    use app\util\DB;
    
    $param = null; $DB = null; $sqlQuery = null; $detail = null;
    
    if(isset($_GET['bno']) === false){
        exit;
    }
    try{
        // 조회
        $param = ["id" => $_GET['bno']];
        $DB = new DB();
        $sqlQuery = $DB->getSqlQuery($_ENV['DB_BOARD_DATAIL']);
        $detail = $DB->handleRequest("GET",$sqlQuery,$param);
    }catch(\PDOException $e){
        echo $e->getMessage();
    }

    try{
        //update
        if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST)){
            $postTitle = $_POST["postTitle"];
            $postContent = $_POST['postContent']; // 내용
            $bno = $_POST['bno']; // 게시물 번호 (URL에서 가져옴)
            $DB = new DB();
            $param =[
                'title' => $postTitle,
                'body'  => $postContent,
                'id'    => intval($bno)
            ];

            $sqlQuery = $DB->getSqlQuery("board.update");
            $result = $DB->handleRequest("FETCH",$sqlQuery,$param);
            if(empty($result)){
                $redirectUrl = "/index.php";
                echo "<script>";
                echo "alert('게시글이 수정되었습니다.');";
                echo "window.location.replace('" . $redirectUrl . "');";
                echo "history.pushState(null, null, '" . $redirectUrl . "');";
                // 페이지 로드 시와 뒤로가기 시 체크
                echo "
                    function preventBack() {
                        window.history.forward();
                    }
                    setTimeout(preventBack, 0);
                    window.onunload = function () { null };
                    
                    // 추가적인 방어
                    window.onpopstate = function() { 
                        window.location.replace('" . $redirectUrl . "');
                        preventBack();
                    };
                ";
                echo "</script>";
            }else{
                echo "<script>alert('게시글 수정에 실패했습니다.');</script>"; // 실패 알림
            }
        }

    }catch(\PDOException $e){
        echo "update DB실패=".$e->getMessage();
    }



?>

<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\header.php'; ?>

    <main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
        <div class="container">
            <h2>게시판</h2>
            <form method="post">
                <?php foreach($detail as $row):?>
                <label for="postTitle">게시물 번호:<?php echo htmlspecialchars($row['id'])  ?></label>
                <input type="hidden" name="bno" value="<?php echo htmlspecialchars($row['id'])  ?>">
                <label for="postTitle">게시물 제목:</label>
                <input type="text" id="postTitle" name="postTitle" value="<?php echo htmlspecialchars($row['title']) ?>" required>
                <label for="postContent">내용:</label>
                <textarea id="postContent" name="postContent" required><?php echo htmlspecialchars($row['body'])?></textarea>
                <?php endforeach;?>
                <button type="submit" name="deatil_submit_button" >변경하기</button>
                <button type="button" name="deatil_cancel_button" onclick="location.href='<?php $_SERVER['DOCUMENT_ROOT'] ?>/index.php'">취소</button>
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

