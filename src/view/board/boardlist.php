<?php 
declare(strict_types=1);
namespace board\boardlist;
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util.php';

use app\Application;
use app\util\DB;

$app = Application::getInstance();
$DB = DB::getInstance();

// 페이지 번호를 URL 파라미터로 받습니다. 기본값은 1입니다.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // 한 페이지에 표시할 게시글 수
$offset = ($page - 1) * $limit;

// 총 게시글 수를 구합니다.
$totalQuery = "SELECT COUNT(*) as total FROM article";
$totalResult = $DB->handleRequest("GET", $totalQuery);
$totalPosts = $totalResult[0]['total'];
$totalPages = ceil($totalPosts / $limit);

try {
    // SQL 쿼리 수정: LIMIT와 OFFSET을 사용하여 페이징 처리
    $sqlQuery = "SELECT id, title, body, regDate FROM article ORDER BY regDate DESC LIMIT :limit OFFSET :offset";
    $boardlist = $DB->handleRequest("GET", $sqlQuery, ['limit' => (int)$limit, 'offset' => (int)$offset]);
} catch(\PDOException $e) {
    echo "boardlist 데이터 조회 실패=" . $e->getMessage();
}

include $_SERVER['DOCUMENT_ROOT'].'/public/header&footer/header.php';
?>
<main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;">
        <a href="..\..\..\index.php">홈으로</a>
    </div>
    <div class="container">
        <h2>게시판 목록</h2>
        <div class="write-button-container">
            <button class="write-button" onclick="location.href='/src/view/board/write.php'">글쓰기</button>
        </div>
        <table class="post-table">
            <thead>
                <tr class="table-header">
                    <th>게시물 제목</th>
                    <th>작성제목</th>
                    <th>작성내용</th>
                    <th>작성일</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($boardlist)) :?>
                    <tr>
                        <td colspan="4">등록된 게시물이 없습니다</td>
                    </tr>
                <?php else:?>
                    <?php foreach($boardlist as $row):?>
                        <tr class="table-row">
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><a href="detail.php?bno=<?php echo htmlspecialchars($row['id']) ?>" class="post-link"><?php echo htmlspecialchars($row['body']); ?></a></td>
                            <td><?php echo htmlspecialchars($row['regDate']); ?></td>
                        </tr>
                     <?php endforeach;?>  
                 <?php endif;?>     
            </tbody>
        </table>
        <div class="pagination">
            <?php
            $pageGroup = ceil($page / 5);
            $startPage = ($pageGroup - 1) * 5 + 1;
            $endPage = min($startPage + 4, $totalPages);
            ?>

            <?php if ($startPage > 1): ?>
                <a href="?page=<?php echo $startPage - 5; ?>">이전</a>
            <?php endif; ?>
            
            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                <a href="?page=<?php echo $i; ?>" <?php if ($i === $page) echo 'style="font-weight: bold;"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <?php if ($endPage < $totalPages): ?>
                <a href="?page=<?php echo $startPage + 5; ?>">다음</a>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/header&footer/footer.php'; ?>