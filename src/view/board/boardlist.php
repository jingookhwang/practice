<?php 
    $connection = mysqli_connect('127.0.0.1', 'sbs', 'sbs1234', 'myproject') or die("데이터 베이스 실패".mysqli_connect_error());

    $sqlQuery = "select id, 
                        regDate, 
                        updateDate, 
                        title, 
                        body  
                  from  article 
                 order  by id desc";   

    $result = mysqli_query($connection,$sqlQuery) or die("데이터 연결 실패".mysqli_error($connection));   

     

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
    <div style="font-size: 50px; text-align: center; margin-bottom: 20px;"><a href="..\..\..\index.php">홈으로</a></div>
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
                <?php if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){ 
                ?>
                <tr class="table-row">
                    <td><a href="#" class="post-link"><?php echo $row['id']; ?></a></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['body']; ?></td>
                    <td><?php echo $row['updateDate']; ?></td>
                </tr>
                <?php }
                }else{
                    echo "데이터가 없습니다".mysqli_close($connection);
                }?>
                


            </tbody>
        </table>
        </div>
    </main>

<?php include '../../../public/header&footer/footer.php'; ?>
</body>
</html>
