app
<?php  
    // ***********  .env setting start**************
    require_once $_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php";
    use Dotenv\Dotenv;


        try {
            //dotenv 로드
            $dotenv = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
            $dotenv->load();
    

            //변수처리
            $dbHost = $_ENV["DB_HOST"];
            $dbName = $_ENV["DB_NAME"];
            $dbUser = $_ENV["DB_USER"];
            $dbPass = $_ENV["DB_PASS"];
            // ***********  .env setting end**************
    
            // ***********  DB connection start**************
            $connection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8",$dbUser,$dbPass); 
            $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );   
            // ***********  DB connection end**************
    
        } catch (Exception $e) {
            return die("데이터 연결 실패 : ".$e->getMessage());
        }
    




?>