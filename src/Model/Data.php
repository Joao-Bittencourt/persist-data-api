<?php

namespace persistDataApi\model;

//use persistDataApi\Config;
use PDO;

class Data extends Model{

    protected $core;

//    public function __construct() {
//        $this->DataSource = DataSource::getInstance();
//    }

    // Get all data
    public function getDatas() {
        $r = array();

        $sql = "SELECT * FROM dados";
        $stmt = $this->DataSource->DB->prepare($sql);


        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = 0;
        }
        return $r;
    }

}
