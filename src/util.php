<?php
    declare(strict_types=1);
    namespace app\util;
    use app\Application;
    
    /**
     * app.php use PDO , use PDOexecption 을 사용하고있어서. 
     * util.php -> \PDO 전역변수 타입 , \PDOexception을 사용하고 위에꺼 사용안해됨
     */
    class DB{
        private \PDO $connection; 

        public function __construct()
        {
            $app = new Application();//힙 생성
            $this -> connection = $app->getConnection();
        }
         /**
         * RESTful API 스타일로 게시판 데이터를 처리합니다.
         *
         * @param string $method HTTP 메소드
         * @param string $sqlQuery SQL 쿼리문
         * @param array $params 쿼리 파라미터
         * @return array|null 쿼리 결과
         * @throws PDOException
         */
        public function handleRequest(String $method ,String $sqlQuery,array $param=[]) : ?array  {
            $stms = null;
            try{
                switch($method){
                    case "GET"    :
                                if(empty($param)){
                                    $stms = $this->connection->prepare($sqlQuery);//준비
                                    $stms->execute();//실행 .param 넣는다
                                    return $stms->fetchAll(\PDO::FETCH_ASSOC);
                                }else{
                                    $stms = $this->connection->prepare($sqlQuery);
                                    foreach ($param as $key => $value) { // foreach 루프 사용, key-value 쌍으로 처리
                                        $stms->bindParam(":" . $key, $value); // 이름 기반 바인딩: ":파라미터_이름", 값
                                    }
                                    $stms->execute();
                                    return $stms->fetchAll(\PDO::FETCH_ASSOC);
                                }
                    case 'POST'   :
                    case 'FETCH'  :
                                if(!empty($param)){
                                    $stms = $this->connection->prepare($sqlQuery);
                                    foreach($param as $key => $value){
                                        $stms->bindValue(":" . $key, $value);
                                    }
                                    $stms->execute();
                                }
                    case 'DELETE' :  
                    default       :
                                  return null;       
                }
                
    
            }catch(\PDOException $e){
                echo "util class = ". $e->getMessage();
            }
            
        }

        public function getSqlQuery(String $selectName){
            $sqlFile = $_SERVER['DOCUMENT_ROOT']."/db.sql";
            $content = file_get_contents($sqlFile);
            if (preg_match("/-- @name: {$selectName}\s*?\n(.*?)(?=-- @name:|\s*--|$)/s", $content, $matches)) {
                /**
                 * print_r($matches) ; 결과값 :
                 * $matches[0] -> -- @name: board.detail SELECT id, regDate, updateDate, title, body FROM article WHERE id = :id;
                 * $matches[1] -> SELECT id, regDate, updateDate, title, body FROM article WHERE id = :id;
                 */
                $query = trim($matches[1]); //변수로 담지 않으면, 겹쳐서 나옴. 왜그런지 모르겠음.
                return $query;
            }
            
            throw new \Exception("SQL 쿼리를 찾을 수 없습니다: {$selectName}");
        }
    }




?>