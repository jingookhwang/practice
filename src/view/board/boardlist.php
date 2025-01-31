<?php require_once $_SERVER['DOCUMENT_ROOT']."/src/util.php";  

$sqlQuery = "select id, 
                    regDate, 
                    updateDate, 
                    title, 
                    body  
              from  article 
             order  by id desc";   

$param = DB__getRow($sqlQuery);
// print_r($param->fetchAll(PDO::FETCH_ASSOC));

?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/header&footer/header.php'; ?>
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
                <?php
                        if($param->rowCount() === 0){
                            die("연결될 로우 없음");
                        }else{
                            $rows = $param->fetchAll(PDO::FETCH_ASSOC);

                            foreach($rows as $row){ ?>

                                <tr class="table-row">
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><a href="detail.php?bno=<?php echo htmlspecialchars($row['id']) ?>" class="post-link"><?php echo htmlspecialchars($row['body']); ?></a></td>
                                    <td><?php echo htmlspecialchars($row['updateDate']); ?></td>
                                </tr>
                          <?php 
                           }
                        }?>
            </tbody>
        </table>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/header&footer/footer.php'; ?>