<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Your Title</title>
    <style>
        body {
            margin: 0;
            padding-bottom: 60px;
            /* footer 높이만큼 여백 추가 */
            min-height: 100vh;
        }

        .content-wrapper {
            padding: 20px;
        }
    </style>
</head>
<?php include $_SERVER['DOCUMENT_ROOT'].'/src/public/header.php'; ?>
<?php

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $email =  isset($_POST) ? $_POST['email'] : "";
        $password = isset($_POST) ? $_POST['password'] : "";
        
        if (!empty($email) && !empty($password)) {
            
            try{
                $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8', "sbs", "sbs1234");
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // 1. 입력값 확인
                echo "POST 데이터:<br>";
                echo "이메일: " . htmlspecialchars($email) . "<br>";
                echo "비밀번호: " . htmlspecialchars($password) . "<br>";
                
                $sql = "SELECT * FROM users WHERE email=:email AND password=:password";
                $stmt = $connection->prepare($sql);
                
                // 2. 바인딩 전 쿼리
                echo "바인딩 전 쿼리: " . $sql . "<br>";
                
                $stmt->bindValue(":email", $email);
                $stmt->bindValue(":password", $password);
                
                // 3. 바인딩된 값 확인
                echo "바인딩된 값:<br>";
                $debugQuery = str_replace(
                    [':email', ':password'],
                    ["'" . htmlspecialchars($email) . "'", "'" . htmlspecialchars($password) . "'"],
                    $sql
                );
                echo "실행될 쿼리: " . $debugQuery . "<br>";
                
                $stmt->execute();
                $count=$stmt->rowCount();

                if ($count === 1) {
                    $_SESSION['email'] = $email;
                    var_dump($_SESSION);
                    header("Location: /index.php");
                    exit;
                    //ant' OR '1'='1
                } else {
                    echo "<script>alert('로그인 실패'); history.back();</script>";
                    exit;
                }
                
        
            }catch(PDOException $e){
                echo "db실패 전체목로=".$e->getMessage();
            }    

            echo "로그인 정보 처리 중...";
        } else {
            echo "이메일과 비밀번호를 모두 입력해주세요.";
        }
    }
?>
<body>
    <div class="content-wrapper">
        <form action="" method="post">
            <h2>로그인</h2>
            <input type="text" name="email" placeholder="이메일" required>
            <h2>비밀번호</h2>
            <input type="password" name="password" placeholder="비밀번호" required>
            <button type="submit" class="dynamic-button" name="btn"> 로그인</button>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/src/public/footer.php'; ?>
</body>

</html>