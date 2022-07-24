<?php

namespace persistDataApi\model;

use PDO;

class Data extends Model {

    public $errors = [];
    private $isValid = false;

    const MAX_LENGH_COLUM_FIELD = 255;

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

    public function insertData($params) {

        foreach ($params as $field => $dado) {
            $dadoToPersist = [];
            $dadoToPersist['field'] = $field;
            $dadoToPersist['dado'] = $dado;

            if (!$this->persist($dadoToPersist)) {
                return false;
            }
        }

        return true;
    }

    public function persist($data) {

        $this->validate($data);

        if ($this->isValid) {

            $data = $this->sanitize($data);
            $dataToPersist[] = empty($data['field']) ? null : $data['field'];
            $dataToPersist[] = empty($data['dado']) ? null : $data['dado'];

            $sql = "INSERT INTO dados ( field, dado) VALUES (?,?)";
            $sth = $this->DataSource->DB->prepare($sql);

            $sth->execute($dataToPersist);

            return true;
        }
        return false;
    }

    private function validate($data) {
        $isValid = true;

        if (!isset($data['field']) || !isset($data['dado'])) {
            $isValid = false;
            $this->errors[] = "Field/Dado can't be null";
        }

        if (!empty($data['field'])) {
            $lenghField = strlen($data['field']);

            if ($lenghField > self::MAX_LENGH_COLUM_FIELD) {
                $isValid = false;
                $this->errors[] = "Field max lengh is 255.";
            }
        }

        $this->isValid = $isValid;
        return $isValid;
    }

    private function sanitize($data) {

        if (!empty($data['field'])) {
            
        }

        if (!empty($data['dado'])) {
            
        }

        return $data;
    }

}
