<?php
namespace ServiceQueries;
class Service {
    private $composer;

    public function __construct($composer) {
        $this->composer = $composer;
    }

    public function create ($params) {
        return $this->composer->create($params);
    }

    public function update ($id, $params) {
        return $this->composer->update($id, $params);
    }

    public function delete ($id) {
        return $this->composer->delete($id);
    }

    public function pagination_model ($colums, $params) {
        return $this->composer->pagination_model($colums, $params);
    }
}