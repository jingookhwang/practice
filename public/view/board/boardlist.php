<?php
    try{
        $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8',"sbs" , "sbs1234");
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $param = [];

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; //기본 1
        $limit = 10; //5페이지
        $offset = ($page-1) * $limit;   // SQL LIMIT 절에서 사용할 offset 계산
        if(isset($_GET['search']) and  trim($_GET['search']) !== ''){
            /**
             서치 검색 문의오면 전체 카운트 검색.
             */
            $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
            $sqlQuery = "select count(*) as total FROM article WHERE body LIKE :search";
            $stms = $connection->prepare($sqlQuery);
            $stms->bindValue(":search","%$search%",PDO::PARAM_STR);
            $stms -> execute();
            //count(*) as total -> ['total'] 을 가져옴, PDO::FETCH_ASSOC 연관 컬럼을 배열로 가져옴
            $total = $stms->fetch(PDO::FETCH_ASSOC)['total'];

            /**
             페이징된 검색 결과를 가져오는 쿼리
             LIMIT :limit OFFSET :offset으로 페이징 처리
             */
            $sqlQuery = "SELECT * FROM article WHERE body LIKE :search ORDER BY id DESC LIMIT :limit OFFSET :offset";
            $stms = $connection->prepare($sqlQuery);
            $stms->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $stms->bindValue(":limit",$limit,PDO::PARAM_INT);
            $stms->bindValue(":offset",$offset,PDO::PARAM_INT);

        }else{
           // 검색어가 없는 경우 (전체 목록)
            // 전체 게시글 수를 계산
            $totalQuery = "SELECT COUNT(*) as total FROM article";
            $stmt = $connection->prepare($totalQuery);
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // 페이징된 전체 목록을 가져오는 쿼리
            $sqlQuery = "SELECT * FROM article ORDER BY id DESC LIMIT :limit OFFSET :offset";
            $stms = $connection->prepare($sqlQuery);
            $stms->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stms->bindValue(':offset', $offset, PDO::PARAM_INT);
            }  
            $stms->execute();
            //전체 결과 $boards
            $boards = $stms->fetchAll();
            
            //토탈 페이지 totalPages ceil 함수는 나눠서 소수점을 반올림해줌.
            $totalPages = ceil($total/$limit);
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
                    <?php else:?>    
                    <!-- 자바스크립트로 데이터가 여기에 추가됩니다 -->
                     <?php foreach ($boards as $rows):  ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rows['id']) ?></td>
                            <td><?php echo htmlspecialchars($rows['title'])?></td>
                            <td>
                                <a href="detail.php?id=<?php echo htmlspecialchars($rows['id']); ?>">
                                    <?php echo nl2br(htmlspecialchars($rows['body'])); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($rows['updateDate'])?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif;?>  
                </tbody>
            </table>
            <div class="pagination">
                  <?php
                        //페이지 그룹 계산
                        $pageGroup = ceil($page/5); //현재 페이지가 속한 그룹 번호
                        $startPage = ($pageGroup - 1) * 5 + 1; // 현재 그룹의 시작 페이지
                        $endPage = min($startPage + 4, $totalPages);  // 현재 그룹의 마지막 페이지
                        $searchCheck = isset($_GET['search']) ? "&search=" . urlencode($_GET['search']) : "";
                  ?> 
                  <!-- "처음" 링크: 현재 페이지가 1 페이지가 아니라면 표시 -->
                <?php if ($page > 1): ?>
                    <a href="?page=1<?php echo $searchCheck; ?>">처음</a>
                <?php endif; ?>
                   <!-- 이전 페이지 그룹으로 이동하는 링크 -->
                <?php if ($startPage > 1): ?>
                    <a href="?page=<?php echo ($startPage - 5) . $searchCheck; ?>">이전</a>
                <?php endif; ?>  
                <!-- 페이지 번호 출력 -->
                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <a href="?page=<?php echo $i . $searchCheck; ?>" 
                    <?php if ($i === $page) echo 'class="active"'; ?> >
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
                <!-- 다음 페이지 그룹으로 이동하는 링크 -->
                <?php if ($endPage < $totalPages): ?>
                    <a href="?page=<?php echo ($startPage + 5) . $searchCheck; ?>">다음</a>
                <?php endif; ?>
                <!-- "끝" 링크: 현재 페이지가 전체 마지막 페이지가 아니라면 표시 -->
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $totalPages . $searchCheck; ?>">끝</a>
                <?php endif; ?>    
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../../view/layout/footer.php'; ?>
</body>
</html>
