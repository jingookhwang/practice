<?php
   
?>

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
<?php include __DIR__ . '/../../view/layout/header.php'; ?>
<?php

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $email =  isset($_POST) ? $_POST['email'] : "";
        $password = isset($_POST) ? $_POST['password'] : "";
        
        if (!empty($email) && !empty($password)) {
            
            try{
                $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8', "sbs", "sbs1234");
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM users WHERE email=:email";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(":email", $email);
                $stmt->execute();
                $count=$stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($count === 1) {
                    $dbpassword = $row['password'];
                    //입력패스워드 , db저장 패스워드
                    var_dump(password_verify($password,$dbpassword)) ;
                    if(password_verify($password,$dbpassword)){
                        //비밀번호 일치
                        $_SESSION['email']=$row['email'];
                        header("Location: /index.php");
                        exit;
                    }else{
                        echo "<script>alert('비밀번호가 틀렸습니다.'); history.back();</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('로그인 실패 이메일을 확인해주세요.'); history.back();</script>";
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
    <?php include __DIR__ . '/../../view/layout/footer.php'; ?>
</body>

</html>