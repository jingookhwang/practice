<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php

    if($_SERVER['REQUEST_METHOD']==="POST" and isset($_POST)){

        $name=trim($_POST['username']);
        $password=trim($_POST['password']);
        $email=trim($_POST['email']);
        if($email===""||$password===""||$email===""){
            $errorMsg = "모든 필드값을 적어주세요.";
        }else{
            try{
                $connection = new PDO('mysql:host=127.0.0.1;dbname=myproject;charset=utf8', "sbs", "sbs1234");
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sqlQuery = "insert into users(username,password,email) values(:username,:password,:email)";
                $hashPassword = password_hash($password,PASSWORD_DEFAULT);
                $stms = $connection->prepare($sqlQuery);
                $stms->bindValue(":username",$name);
                $stms->bindValue(":password",$hashPassword);
                $stms->bindValue(":email",$email);

                $stms->execute();
                $count=$stms->rowCount();

                if($count > 0){
                    header("Location: /index.php");
                    exit;
                }
        
            }catch(PDOException $e){
                if($e->getCode() === "23000"){
                    $errorMsg="이미 있는 이메일입니다";
                }else{
                    echo "isnewuser error=".$e->getMessage();
                }
            }
        }
    }

?>
<?php include __DIR__ . '/../../view/layout/header.php'; ?>
    <body>
        <h2>회원가입</h2>
        <?php if(isset($errorMsg)):?>
            <p style="color: red;"><?php echo htmlspecialchars($errorMsg) ?>
        <?php endif;?>
            <form  method="post">
                <div>
                    <label for="username">이름</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div>
                    <label for="password">비밀번호</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div>
                    <label for="email">이메일</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <input type="submit" value="회원가입">
                </div>
            </form>


    </body>

</html>