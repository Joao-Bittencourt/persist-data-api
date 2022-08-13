<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace persistDataApi\Model;

use persistDataApi\Config\DataSource;

class Model {

     public function __construct() {
        
        
        $this->DataSource = DataSource::getInstance();
    }
}
