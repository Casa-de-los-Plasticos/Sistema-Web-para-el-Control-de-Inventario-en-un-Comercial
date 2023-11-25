<?php
class Views{
    public function getView($ruta, $nombre, $data = "")
    {
        if ($ruta == 'principal') {
            $vista = 'views/' . $nombre . '.php';
        }else{
            $vista = 'views/'. $ruta. '/' . $nombre . '.php';
        }
        require $vista;
    }
}

?>