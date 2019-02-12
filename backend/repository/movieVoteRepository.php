<?php

require_once __DIR__ . '/../config/connection.php';

class movieVoteRepository {

    public static $instance;
 
    private function __construct() {
        //
    }
    
    //Creates a self instance of the class checking if it hasn't be already create
    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new movieVoteRepository();
 
        return self::$instance;
    }

    public function getFilmes() {
        try {
            $result = array();
            $sql = "SELECT * FROM lista_filmes";
            $p_sql = Connection::getInstance(__DIR__ . '/../config/configdb.ini')->prepare($sql);
            if ($p_sql->execute()) {
                $data = $p_sql->fetch(PDO::FETCH_ASSOC);
                return $data;
            } else {
                return 'No match found!';
            }
        } catch (Exception $e) {
            print($e);
        }
    }

    public function getFilme($number) {
        try {
            $sql = "SELECT filme0" . $number . " FROM lista_filmes";
            $p_sql = Connection::getInstance(__DIR__ . '/../config/configdb.ini')->prepare($sql);
            if ($p_sql->execute()) {
                $data = $p_sql->fetch(PDO::FETCH_ASSOC);
                return $data;
            } else {
                return 'No match found!';
            }
        } catch (Exception $e) {
            print($e);
        }
    }

    public function updateFilme($number, $value) {
        try {
            $sql = "UPDATE lista_filmes SET filme0" . $number ." = " . $value . " WHERE 1";
            $p_sql = Connection::getInstance(__DIR__ . '/../config/configdb.ini')->prepare($sql);
            $response = $p_sql->execute();
            return $response;
        } catch (Exception $e) {
            print($e);
        }
    }
}