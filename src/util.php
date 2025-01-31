util

<?php require_once $_SERVER['DOCUMENT_ROOT']."/src/app.php"; 
    //전체 목록
    function DB__getRow($sqlQuery){
        global $connection;
        print_r ($connection);
        try{
            $stms = $connection->prepare($sqlQuery);
            $stms->execute();
            // print_r($stms->rowCount());
            return $stms;
        }catch(PDOException $e){
            die("쿼리 실패=".$e->getMessage() );
        }
        
    }


?>