<?php 
declare(strict_types=1);
namespace board\boardlist;
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util.php';
use app\util\DB;

$DB = new DB();
try{
    echo $_ENV['DB_BOARD_LIST'];
    $sqlQuery = $DB->getSqlQuery($_ENV['DB_BOARD_LIST']);
    $boardlist= $DB->handleRequest("GET",$sqlQuery);
}catch(\PDOException $e){
    echo "boardlist 데이터 조회 실패=".$e->getMessage();
}

include $_SERVER['DOCUMENT_ROOT'].'/public/header&footer/header.php';
?>
<main>
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a>
    </div>
    <div class="container">
        <h2>게시판 목록</h2>
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
                            <td><?php echo htmlspecialchars($row['updateDate']); ?></td>
                        </tr>
                     <?php endforeach;?>  
                 <?php endif;?>     
            </tbody>
        </table>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/header&footer/footer.php'; ?>