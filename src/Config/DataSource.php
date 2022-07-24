<?php

namespace persistDataApi\Config;

use PDO;

class DataSource {

    public $DB; // handle of the db connexion
    private static $instance;

    private function __construct() {


        $servername = @$_ENV['DB_APP_HOST'];
        $username = @$_ENV['DB_APP_USER'];
        $password = @$_ENV['DB_APP_PASSWORD'];

        $bd = @$_ENV['DB_APP_DATABASE'];
        $port = @$_ENV['DB_APP_PORT'];

        $flags = array(
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        if (empty($servername) || empty($username) || empty($password) || empty($bd) || empty($port)) {
            throw new \Exception('Parametros de conexao com banco de dados invalido');
        }

        try {
            $this->DB = new PDO(
                    "pgsql:host={$servername};port={$port};dbname={$bd};sslmode=allow",
                    $username,
                    $password,
                    $flags
            );
        } catch (PDOException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

}
