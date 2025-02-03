<?php
    declare(strict_types=1);
    namespace app\util;
    use app\Application;
    
    /**
     * app.php use PDO , use PDOexecption 을 사용하고있어서. 
     * util.php -> \PDO 전역변수 타입 , \PDOexception을 사용하고 위에꺼 사용안해됨
     */
    class DB{
        private static ?DB $instance = null;
        private \PDO $connection; 
        

        private function __construct()
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
                                    $stms = $this->connection->prepare($sqlQuery);
                                    $stms->execute();
                                    return $stms->fetchAll(\PDO::FETCH_ASSOC);
                                }else{
                                    $stms = $this->connection->prepare($sqlQuery);
                                    foreach ($param as $key => $value) {
                                        // 바인딩 타입을 명시적으로 지정
                                        $stms->bindValue(":" . $key, $value, is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                                    }
                                    $stms->execute();
                                    return $stms->fetchAll(\PDO::FETCH_ASSOC);
                                }
                                break;
                    case 'POST'   :
                                $stms = $this->connection->prepare($sqlQuery);
                                foreach($param as $key => $val){
                                    $stms->bindValue(":".$key , $val);
                                }
                                echo "result";
                                print_r($stms->debugDumpParams());
                                $stms->execute();
                                return $stms->rowCount() > 0 ? [] : null;
                                break;
                    case 'FETCH'  :
                                if(!empty($param)){
                                    $stms = $this->connection->prepare($sqlQuery);
                                    foreach($param as $key => $value){
                                        $stms->bindValue(":" . $key, $value);
                                    }
                                    $stms->execute();
                                    return $stms->rowCount() > 0 ? [] : null;
                                }
                                break;
                    case 'DELETE' :  
                                // DELETE 로직 추가
                                break;
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

        public static function getInstance(): DB {
            if (self::$instance === null) {
                self::$instance = new DB();
            }
            return self::$instance;
        }

        public function getConnection(): \PDO {
            return $this->connection;
        }
        /**
         * PDOStatement에 파라미터를 안전하게 바인딩하는 함수입니다.
         *
         * 전달된 값의 타입에 따라 적절한 PDO 파라미터 상수를 선택하고
         * named placeholder에 값을 바인딩합니다.
         *
         * @param PDOStatement $stmt  준비된 PDO 쿼리 객체
         * @param string       $key   바인딩할 파라미터 이름 (콜론(:)은 내부에서 자동 추가)
         * @param mixed        $value 바인딩할 값
         * @return bool 바인딩 성공 여부
         * @throws InvalidArgumentException 지원하지 않는 타입의 값인 경우 예외 발생
         */
        function bindParameterAdvanced(\PDOStatement $stmt, string $key, $value): bool {
            if (is_null($value)) {
                $paramType = \PDO::PARAM_NULL;
            } elseif (is_bool($value)) {
                $paramType = \PDO::PARAM_BOOL;
            } elseif (is_int($value)) {
                $paramType = \PDO::PARAM_INT;
            } elseif (is_float($value)) {
                // PDO는 부동소수점 타입을 직접 지원하지 않으므로 문자열로 캐스팅
                $value = (string)$value;
                $paramType = \PDO::PARAM_STR;
            } elseif (is_string($value)) {
                $paramType = \PDO::PARAM_STR;
            } else {
                // 배열, 객체 등 지원하지 않는 타입은 예외 처리
                throw new \InvalidArgumentException("지원하지 않는 타입의 값을 바인딩하려고 합니다. key: {$key}");
            }
            
            // named placeholder는 ':'를 포함해야 하므로 내부에서 자동으로 추가합니다.
            return $stmt->bindValue(':' . $key, $value, $paramType);
        }
    }




?>