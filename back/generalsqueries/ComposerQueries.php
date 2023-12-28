<?php
namespace GeneralsQueries;
use App\Helpers\HelperNotify;
use Illuminate\Support\Facades\Log;

class ComposerQueries {
    private $model;
    private $view;
    public $info = ['result' => false, 'message' => ['title' => 'Error!', 'content' => 'Internal Server Error.']];
    public $message;
    public $request;
    

    public function __construct($model, $view, $message, $request) {
        $this->model = $model;
        $this->view = $view;
        $this->message = $message;
        $this->request = $request;
    }

    // ESTE ES EL MÉTODO UTILIZADO PARA VALIDAR CON validate DONDE $this->model EN ESTA OCACIÓN ES EL MODELO
    // Messages
    // LO IDEAL ES QUE AQUÍ APUNTEN LOS DEMÁS MODELOS SIN NECESIDAD DE VOLVER A REALIZAR LOS MÉTODOS COMO C.R.U.D
    public function fieldsValidation () {
        try {
            $validate = $this->request->validate($this->model::$rules);
            $this->info['result'] = true;
            return $this->info;
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            $errors = $validationException->errors();

            $errors = $validationException->errors();
            $this->info['result'] = false; 
            $this->info['message'] = isset($errors['para']) ? $this->helper()->getNotify('exception', $errors['para'][0]) : '';
            $this->info['message'] = (!isset($errors['para']) && isset($errors['asunto'])) ? $this->helper()->getNotify('exception', $errors['asunto'][0]) : $this->helper()->getNotify('exception', isset($errors['para']) ? $errors['para'][0] : '') ;
            if (!isset($errors['asunto']) && !isset($errors['para'])) {
                $this->info['message'] = $this->helper()->getNotify('exception', $errors['contenido'][0]);
            }
    
            return $this->info;
        }
    }

    // ARCHIVO UTILIZADO PARA RETORNAR UN MENSAJE AL FRONT Y SE MUESTRE COMO NOTIFICACIÓN 
    public function helper () {
        return new HelperNotify();
    }

    public function create ($data) {
        try {
            $validation = $this->fieldsValidation();
            if ($validation['result']) {
                $create = $this->model::create($data);
                if ($create) {
                    $this->info['result'] = true;
                    // A CONTINUACIÓN SE LE MANDA SI ES SATISFACTORIA LA RESPUESTA Y EL MENSAJE
                    // EN EL ARCHIVO HelperNotify SE PUEDE APRECIAR COMO SE PROCESA LO ANTES MENCIONADO
                    $this->info['message'] = $this->helper()->getNotify('success', ucfirst("$this->message ha sido creado."));
                } else {
                    $this->info['result'] = false;
                    $this->info['message'] = $this->helper()->getNotify('error', ucfirst("$this->message no se pudo crear."));
                }
            }
        } catch (\Exception $e) {
        }
        return $this->info;
    }

    public function update ($id, $data) {
        try {
            $update = $this->model::where('id', $id)->update($data);
            if ($update) {
                $this->info['result'] = true;
                $this->info['message'] = $this->helper()->getNotify('success', ucfirst("$this->message ha sido actualizado."));
            } else {
                $this->info['result'] = false;
                $this->info['message'] = $this->helper()->getNotify('error', ucfirst("$this->message no se pudo actualizar."));
            }
        } catch (\Exception $e) {
        }
        return $this->info;
    }

    public function delete ($id) {
        
        try {
            $delete = $this->model::where('id', $id)->delete();
            if ($delete) {
                $this->info['result'] = true;
                $this->info['message'] = $this->helper()->getNotify('success', ucfirst("$this->message ha sido eliminado."));
            } else {
                $this->info['result'] = false;
                $this->info['message'] = $this->helper()->getNotify('error', ucfirst("$this->message no se pudo eliminar."));
            }
        } catch (\Exception $e) {
        }
        return $this->info;
    }

    public function pagination_model ($columns, $filter) {
        $where = '';
        $or = '';
        $and = '';
        $getAll = $this->model::query();

        // HandleFiters ES UTILIZADO PARA PROCESAR EL TIPO DE DATO DE LOS FILTROS QUE SE ENVÍAN DESDE EL FRONT
        $handle = new HandleFilters();
        if (isset($filter['conditions'])) {
            foreach ($filter['conditions'] as $key => $value) {
                $and .= $value[0]. " ".$value[1]." ".$handle->type_data($value[2]). " AND ";
            }
            $where .= rtrim($and, ' AND');
        }
        
        if (isset($filter['pagination'])) {
            $sortBy = $filter['pagination']['sortBy'];
            $desc = $filter['pagination']['descending'] == 'true' ? 'desc' : 'asc';
            $getAll->orderBy($sortBy, $desc);
            if ($where !== '') {
                $getAll->whereRaw($where)->get();
            }else {
                $getAll->get();
            }
            $this->info['result'] = $getAll->count() > 0 ? true : false;
            $this->info['data'] = $getAll->paginate($filter['pagination']['rowsPerPage'], ['*'], 'page', $filter['pagination']['page']);
            
            
        }else {
            if ($where !== '') {

                $this->info['data'] = $getAll->whereRaw($where)->get();
                $this->info['result'] = $getAll->count() > 0 ? true : false;
            }else {
                $this->info['data'] = $getAll->get();
                
                $this->info['result'] = $getAll->count() > 0 ? true : false;
            }
        }
        
        return $this->info;
    }
}