<?php

require_once __DIR__ . '/../repository/movieVoteRepository.php';

class movieVoteService {

    public static $instance;
 
    private function __construct() {
        //
    }
    
    //Creates a self instance of the class checking if it hasn't be already create
    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new movieVoteService();
 
        return self::$instance;
    }

    public function getFilmes() {
        $response = movieVoteRepository::getInstance()->getFilmes();
        return $response;
    }

    public function vote($number) {
        $value = movieVoteRepository::getInstance()->getFilme($number);
        $value = array_values($value);
        $value = intval($value[0]);
        $value = $value + 1;
        $vote = movieVoteRepository::getInstance()->updateFilme($number, $value);
        return $vote;
    }
}