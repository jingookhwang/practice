<?php 
namespace App;
require_once __DIR__ . '/vendor/autoload.php';

class util{

    private static $instance = null;
    private function __construct(){
        $env = \Dotenv\Dotenv::createImmutable(__DIR__);
        $env->load();
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance =  new self();
        }
        return self::$instance;
    }

    public function layout(String $road): void{
        if($road === "header"){
            include $_SERVER['DOCUMENT_ROOT'].$_ENV['header_layout'];
        }else{
            include $_SERVER['DOCUMENT_ROOT'].$_ENV['footer_layout'];
        }
    }

    

}


?>