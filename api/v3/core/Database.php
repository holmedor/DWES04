<?php
ini_set('display_errors','On');

class Database{

    private $config=[];

    public static function connect(){
        $db = new PDO('mysql:host=localhost;dbname=biblioteca;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $libros=$db->query("SELECT * FROM libros");
        $libros=$libros->fetchAll(PDO::FETCH_ASSOC);

        return $libros;
    }
    public static function getAll(){
        $db = new PDO('mysql:host=localhost;dbname=biblioteca;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $libros=$db->query("SELECT * FROM libros");
        $libros=$libros->fetchAll(PDO::FETCH_ASSOC);

        return $libros;
    }
    public static function getByID($id){
        $db = new PDO('mysql:host=localhost;dbname=biblioteca;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $libros=$db->query("SELECT * FROM libros where id=$id");
        $libros=$libros->fetchAll(PDO::FETCH_ASSOC);

        return $libros;
    }
    public static function loadConfig(){
        $json_file=file_get_contents('../conf/db-conf.json');
        $config=json_decode($json_file,true);

        $db_host=$config['host'];
        $db_user=$config['user'];
        $db_pass=$config['password'];
        $db_bd=$config['db_name'];

        echo 'Host '.$db_host . '<br>';
        echo 'User '.$db_user . '<br>';
        echo 'Pass '.$db_pass . '<br>';
        echo 'BD '.$db_bd . '<br>';
    }

}

?>