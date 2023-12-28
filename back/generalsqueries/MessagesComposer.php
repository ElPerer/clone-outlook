<?php
namespace GeneralsQueries;
class MessagesComposer extends ComposerQueries{
    private $model;
    private $view;
    public function __construct($model, $view, $message, $request) {
        parent::__construct($model, $view, $message, $request);
        $this->model = $model;
        $this->view = $view;
    }
}