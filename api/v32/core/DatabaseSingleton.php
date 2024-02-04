<?php

class DatabaseSingleton{

    private static $instance;

    private $connection;

    private $config=[];

//    public static function loadConfig(){
    public function loadConfig(){ //SI ES static NO FUNCIONA!!!
        $json_file=file_get_contents('../conf/db-conf.json');
//        $config=json_decode($json_file,true);
        $this->config=json_decode($json_file,true);//$config sería local a la función loadConfig()!!!???
/*        $db_host=$this->config['host'];
        $db_user=$this->config['user'];
        $db_pass=$this->config['password'];
        $db_bd=$this->config['db_name'];

        echo 'Host '.$db_host . '<br>';
        echo 'User '.$db_user . '<br>';
        echo 'Pass '.$db_pass . '<br>';
        echo 'BD '.$db_bd . '<br>';*/
    }

    private function __construct(){
        $this->loadConfig();
//        var_dump($this->config);
//        print_r($this->config);
//        var_dump($this->config['host']);
//        var_dump($this->config['db_name']);
//        var_dump($this->config['user']);
//        var_dump($this->config['password']);
        $this->connection=new PDO(
            "mysql:host={$this->config['host']};dbname={$this->config['db_name']}",
            $this->config['user'], 
            $this->config['password']
        );
    } 
    
    public static function getInstance(){
        if(!self::$instance){
            self::$instance=new self();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }
}

?>