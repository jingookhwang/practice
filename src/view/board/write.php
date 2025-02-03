<?php
declare(strict_types=1);    
namespace board\write;

use app\util\DB;
use app\Application;
use app\util;

session_start(); // 세션 시작 추가

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util.php';    


if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST)){
    $postTitle = $_POST["postTitle"];
    $postContent = $_POST['postContent'];
    
    $app = Application::getInstance();
    $DB = DB::getInstance();
    
    try {
        $sqlQuery = $DB->getSqlQuery("board.insert");
        $param = [
            'title' => $postTitle,
            'body'  => $postContent
        ];
        $result = $DB->handleRequest("POST",$sqlQuery,$param);
        
        // 플래시 메시지 저장
        $_SESSION['flash_message'] = '글이 작성되었습니다.';
        
        header("Location: /index.php");
        exit();
       
    } catch(\PDOException $e) {
        header("Location: /error.php");
        exit();
    }
}


?>
<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\header.php'; ?>

    <main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
        <div class="container">
            <h2>게시판</h2>
            <form method="POST">
                <label for="postTitle">게시물 제목:</label>
                <input type="text" id="postTitle" name="postTitle" placeholder="게시물 제목을 입력하세요" required>
                <label for="postContent">내용:</label>
                <textarea id="postContent" name="postContent" placeholder="게시물 내용을 입력하세요.(10자)" required rows="10"></textarea>
                <button type="submit">작성완료</button>
                <button type="button" onclick="location.href='../../../index.php'">취소</button>
            </form>
        </div>
    </main>

<?php include $_SERVER["DOCUMENT_ROOT"].'\public\header&footer\footer.php'; ?>
