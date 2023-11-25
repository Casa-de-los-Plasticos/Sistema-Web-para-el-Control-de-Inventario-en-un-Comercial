<?php
class Controller{
    protected $views, $model;
    public function __construct() {
        $this->views = new Views();
        $this->cargarModel();
    }
    public function cargarModel()
    {
        $modelName = get_class($this).'Model';
        $ruta = 'models/' . $modelName . '.php';
        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $modelName();
        }
    }
}

?>