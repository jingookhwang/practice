util

<?php require_once $_SERVER['DOCUMENT_ROOT']."/src/app.php"; 
    //전체 목록
    function BOARD_RESTfull_API($method , $sqlQuery, $param=[]){
        global $connection;
        $stms = null;
        try{
            switch($method){
                case "GET" : 
                    $stms = $connection->prepare($sqlQuery);//db준비
                    $stms->execute();//실행
                    return $stms->fetchAll(PDO::FETCH_ASSOC);//결과값 배열로 반환
                case "PUT" :
                    return $stms; 
                case "FETCH" :
                    return $stms; 
                case "DELETE" : 
                    return $stms;
                default :
                    break;        
                    

            }


        }catch(PDOException $e){
            die("pdo쿼리 실패=".$e->getMessage() );
        }
        
    }




?>