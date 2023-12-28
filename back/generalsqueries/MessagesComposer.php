<?php
namespace GeneralsQueries;
// ESTE ARCHIVO ES PARA CUANDO EXISTA UN COMPORTAMIENTO TOTALMENTE DIFERENTE A LO CONVENCIONAL COMO
// Create, Read, Update, Delete
// ESTE ARCHIVO YA TRAE LOS MÉTODOS DE ComposerQueries COMO, create, delete, pagination_model y update
class MessagesComposer extends ComposerQueries{
    private $model;
    private $view;
    public function __construct($model, $view, $message, $request) {
        // SE LE PASA AL PADRE ComposerQueries AL CONSTRUCTOR LOS SIGUIENTE PARÁMETROS
        parent::__construct($model, $view, $message, $request);
        $this->model = $model;
        $this->view = $view;
    }
}