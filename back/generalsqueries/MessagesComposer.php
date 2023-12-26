<?php
namespace GeneralsQueries;
class MessagesComposer extends ComposerQueries{
    private $model;
    private $view;
    public function __construct($model, $view, $message) {
        parent::__construct($model, $view, $message);
        $this->model = $model;
        $this->view = $view;
    }
}