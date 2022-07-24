<?php

namespace persistDataApi\Config;

use PDO;

class DataSource {

    public $DB; // handle of the db connexion
    private static $instance;

    private function __construct() {


        $servername = !empty($_ENV['DB_APP_HOST']) ? $_ENV['DB_APP_HOST'] : null;
        $username = !empty($_ENV['DB_APP_USER']) ? $_ENV['DB_APP_USER'] : null;
        $password = !empty($_ENV['DB_APP_PASSWORD']) ? $_ENV['DB_APP_PASSWORD'] : null;

        $bd = !empty($_ENV['DB_APP_DATABASE']) ? $_ENV['DB_APP_DATABASE'] : null;
        $port = !empty($_ENV['DB_APP_PORT']) ? $_ENV['DB_APP_PORT'] : null;

        $flags = array(
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        if (empty($servername) || empty($username) || empty($password) || empty($bd) || empty($port)) {
            throw new \Exception('Parametros de conexao com banco de dados invalido');
        }

        try {
            $this->DB = new \PDO(
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
