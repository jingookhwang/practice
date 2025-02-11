<?php
    try{
        $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8',"sbs" , "sbs1234");
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $param = [];
        
        if(isset($_GET['search']) and  trim($_GET['search']) !== ''){
            /**
             서치 리스트
             */
            $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
            $sqlQuery = "select * from article where body like :search order by id desc";
            $stms = $connection->prepare($sqlQuery);
            $stms->bindValue(":search","%$search%",PDO::PARAM_STR);
            $stms -> execute();
            $boards = $stms->fetchAll();

        }else{
            /**
             전체 페이지 리스트
             */
            
                $sqlQuery = "select * from article order by id DESC";
                $stms = $connection -> prepare($sqlQuery);//준비
                $stms -> execute();
                $boards = $stms->fetchAll();
        }  
        
        
    }catch(PDOException $e){
        echo "db실패 전체목로=".$e->getMessage();
}

?>
<?php include __DIR__ . '/../../view/layout/header.php'; ?>
    <script>
        
 
    </script>





    <div class="content-wrapper">
        <div class="board-container">
            <h1>게시판</h1>
            
            <div class="action-container">
                <div class="search-container">
                    <form method="get">
                    <input type="text" name="search" class="search-input" placeholder="검색어를 입력하세요">
                    <button class="search-btn">검색</button>
                    </form>
                </div>
                <button class="write-btn" onclick="showWriteForm()">글쓰기</button>
            </div>
            
            <table class="board-table">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>작성제목</th>
                        <th>작성일</th>
                    </tr>
                </thead>
                <tbody id="boardList" class="boardList">
                    <?php if(empty($boards)):?>
                        <tr>
                        <td colspan="4">검색 결과 없음</td>
                        </tr>
                    <?php endif;?>    
                    <!-- 자바스크립트로 데이터가 여기에 추가됩니다 -->
                     <?php foreach ($boards as $rows):  ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rows['id']) ?></td>
                            <td><?php echo htmlspecialchars($rows['title'])?></td>
                            <td>
                                <a href="write.php?id=<?php echo htmlspecialchars($rows['id']); ?>">
                                    <?php echo nl2br(htmlspecialchars($rows['body'])); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($rows['updateDate'])?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include __DIR__ . '/../../view/layout/footer.php'; ?>
</body>
</html>
