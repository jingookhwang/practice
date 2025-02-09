<?php


        try{
            $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8',"sbs" , "sbs1234");
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            var_dump($connection instanceof PDO);
            $param = [];
            if($connection instanceof PDO === true){
                $sqlQuery = "select * from article order by id DESC";
                $stms = $connection -> prepare($sqlQuery);//준비
                $stms -> execute();
                $param = $stms->fetchAll();
            }  


        }catch(PDOException $e){
            echo "db실패 전체목로=".$e->getMessage();
        }


?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/src/public/header.php'; ?>
<script>
        $(document).ready(function(){

            const param = <?php echo json_encode($param)?>    
            const output = $('.boardList');
            output.empty();
            param.forEach(val=>{
                const tableBody = $('<tr>');
                tableBody.append($('<td>').text(val.id));
                tableBody.append($('<td>').text(val.title));
                tableBody.append(
                    $('<td>').append(
                    $('<a>')
                    .attr('href', 'src/public/boardupdate.php?id=' + val.id)
                    .text(val.body)
                    )
                );
                tableBody.append($('<td>').text(val.regDate));
                output.append(tableBody);
            });

            $('#searchInput').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                searchPosts(searchTerm);
            });
            });



        
    </script>





    <div class="content-wrapper">
        <div class="board-container">
            <h1>게시판</h1>
            
            <div class="action-container">
                <div class="search-container">
                    <input type="text" id="searchInput" class="search-input" placeholder="검색어를 입력하세요">
                    <button class="search-btn" onclick="searchPosts()">검색</button>
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
                    <!-- 자바스크립트로 데이터가 여기에 추가됩니다 -->
                </tbody>
            </table>
        </div>
    </div>

    

<?php include $_SERVER['DOCUMENT_ROOT'].'/src/public/footer.php'; ?>
</body>
</html>
