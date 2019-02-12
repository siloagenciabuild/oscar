<?php

    final class Connection {

        private static $connection;

        private function __construct(){}
        private function __clone(){}
        private function __wakeup(){}

        private static function load(string $file): array {

            if (file_exists($file)) {
                $parameters = parse_ini_file($file);
            } else {
                throw new Exception ('Error: file not found');
            }
            return $parameters;
        }

        private static function make(array $parameters): PDO {

            $sgdb = isset($parameters['sgdb']) ? $parameters['sgdb'] : NULL;
            $user = isset($parameters['user']) ? $parameters['user'] : NULL;
            $pass = isset($parameters['pass']) ? $parameters['pass'] : NULL;
            $database = isset($parameters['database']) ? $parameters['database'] : NULL;
            $host = isset($parameters['host']) ? $parameters['host'] : NULL;
            $port = isset($parameters['port']) ? $parameters['port'] : NULL;

            if(!is_null($sgdb)) {
                // Create the connection string and select the property Database
                switch (strtoupper($sgdb)) {
                    case 'MYSQL' : $port = isset($port) ? $port : 3306 ; return new PDO("mysql:host={$host};port={$port};dbname={$database}", $user, $pass);
                       break;
                    case 'MSSQL' : $port = isset($port) ? $port : 1433 ;return new PDO("mssql:host={$host},{$port};dbname={$database}", $user, $pass);
                       break;
                    case 'PGSQL' : $port = isset($port) ? $port : 5432 ;return new PDO("pgsql:dbname={$database}; user={$user}; password={$pass}, host={$host};port={$port}");
                       break;
                    case 'SQLITE' : return new PDO("sqlite:{$database}");
                       break;
                    case 'OCI8' : return new PDO("oci:dbname={$database}", $user, $pass);
                       break;
                    case 'FIREBIRD' : return new PDO("firebird:dbname={$database}",$user, $pass);
                       break;
                }
            } else {
                throw new Exception('Error: no Database found');
            }
        }

        public static function getInstance(string $file):PDO {

            if (self::$connection == NULL) {
                self::$connection = self::make(self::load($file));
                self::$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection -> exec("set names utf8");
                $sql = "
                CREATE TABLE IF NOT EXISTS `lista_filmes` (
                    `filme01` int(10),
                    `filme02` int(10),
                    `filme03` int(10),
                    `filme04` int(10),
                    `filme05` int(10)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                INSERT INTO lista_filmes 
                SELECT 0,0,0,0,0 
                WHERE NOT EXISTS (SELECT * FROM lista_filmes);
                  ";
                $p_sql = Connection::getInstance('configdb.ini')->prepare($sql);
                $p_sql->execute();
            }
            return self::$connection;
        }

        public function lastInsertId(){
            return $this->lastInsertId();
        }    
    }

?>