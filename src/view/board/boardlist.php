<?php 
    $connection = mysqli_connect('127.0.0.1', 'sbs', 'sbs1234', 'myproject') or die("데이터 베이스 실패".mysqli_connect_error());

    $sqlQuery = "select id, 
                        regDate, 
                        updateDate, 
                        title, 
                        body  
                  from  article 
                 order  by id desc";   

    /**
      $statement = mysqli_prepare($connection,$sqlQuery) : mysqli_prepare 함수는 SQL 쿼리를 준비하는 데 사용됩니다
      true / false 반환
      
      mysqli_stmt_execute($statement) : mysql 예문 실행 
      int 1,0 값 반환
      
      $result = mysqli_stmt_get_result($statement); : 준비된 문(statement)에서 결과 집합을 가져오는 데 사용됩니다.
      성공시 array 반환 // 실패 false 반환

      mysqli_num_rows($result)
      성공시 int 1 , 0 반환

      mysqli_fetch_assoc($result) 
      성공시 array 쿼리 반환 , 실패시 false

      echo htmlspecialchars($row['id'])
      텍스트 문자열 반환. html 텍스트로 저장되기에 echo 를 붙여야하고, 값을 변형 못한다.
    
     */
    $statement = mysqli_prepare($connection,$sqlQuery); //쿼리 준비 단계 //true // false 반환
    mysqli_stmt_execute($statement);//쿼리 예문 실행 int 값으로 반환
    $result = mysqli_stmt_get_result($statement);
    if ($result === false) {
        die("데이터 연결 실패".mysqli_error($connection));
    }

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인 페이지</title>
    <link rel="stylesheet" href="../../../public\resource\index.css?v=1">
    <link rel="stylesheet" href="../../../public\resource\boardlist.css?v=1">
</head>

<body>
    <?php include '../../../public/header&footer/header.php'; ?>
    <main>
        <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a>
        </div>
        <div class="container">
            <h2>게시판 목록</h2>
            <link rel="stylesheet" href="public/resource/table.css?v=1">

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
                        if(mysqli_num_rows($result) === 0){
                            die("연결될 로우 없음".mysqli_close($connection));
                        }else{
                            while($row = mysqli_fetch_assoc($result)){ ?>
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

    <?php include '../../../public/header&footer/footer.php'; ?>
</body>

</html>