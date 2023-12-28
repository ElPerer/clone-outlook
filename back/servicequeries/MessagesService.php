<?php
namespace ServiceQueries;
class MessagesService extends Service {
    private $composer;
    public function __construct($composer) {
        // SE LE PASA AL PADRE Service AL CONSTRUCTOR LOS SIGUIENTE PARÁMETROS
        // RECORDEMOS QUE $composer YA TRAE LOS MÉTODOS DE ComposerQueries ES DECIR PODEMOS UTILIZAR LA FUNCIÓN DE 
        // create, update, pagination_model y delete DEL ARCHIVO ComposerQueries A SU VEZ SE PASAN AL ARCHIVO Service
        parent::__construct($composer);
        $this->composer = $composer;
    }

}