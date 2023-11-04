<?php 
    // CONTROLLADOR PARA LAS PETICIONES AJAX Y CONECIONES CON LA BASE DE DATOS
    if (!$_SERVER['REQUEST_METHOD'] === 'POST') { // se verifica que sea una peticion autentica
	    die('Invalid Request');
    }

    require_once 'Db.php';


    class Ajax {
        private $controller = "Ajax";
        private $ajaxMethod;
        private $data;
        private $db;

        public function __construct(){
            $this->db = new Db;
            $this->ajaxMethod = isset($_POST['ajaxMethod']) ? $_POST['ajaxMethod'] : NULL ;
            unset($_POST['ajaxMethod']);

            $this->data = [$_POST];

            if(method_exists($this->controller, $this->ajaxMethod)){
                call_user_func_array([$this->controller, $this->ajaxMethod], $this->data);
            }else{
                $this->ajaxRequestResult(false, "Metodo inexistente");
            }
        }

        //E: bool, str
        //S: none
        // Metodo para enviar las respuestas de ajax al js mediante un echo
        private function ajaxRequestResult($success = false, $message = 'Error desconocido', $dataResult = NULL){
            $result = array(
                'Success' => $success,
                'Message' => $message,
                'Data'    => $dataResult
            );
            echo json_encode($result);
        }


        // Metodo de prueba
        private function foo($data){
            $this->ajaxRequestResult(true, $data['message']);
        }

        // METODO PARA CARGAR LOS EVENTOS PARA EL FORMULARIO
        private function loadFormSelectEvents($data){
            $sql = "SELECT idEvento, nombreEvento, precioEvento FROM eventos";
            $this->db->query($sql);
            $events = $this->db->results();
            foreach($events  as $event){ ?>
                <option value="<?php echo $event->idEvento ?>"> <?php echo $event->nombreEvento; ?> </option>
            <?php }
        }

        // METODO PARA CARGAR LAS PROVINCES PARA EL FORMULARIO
        private function loadFormSelectProvinces($data){
            $sql = "SELECT idProvincia, nombreProvincia FROM provincias";
            $this->db->query($sql);
            $provinces = $this->db->results();
            ?> 
                <option value="">Provincias</option>
            <?php
            foreach($provinces  as $province){ ?>
                <option value="<?php echo $province->idProvincia ?>"> <?php echo $province->nombreProvincia; ?> </option>
            <?php }
        }

        // METODO PARA CARGAR LAS PROVINCES PARA EL FORMULARIO
        private function loadFormSelectCantons($data){
            $sql = "SELECT idCanton, nombreCanton, precioCanton FROM cantones WHERE idProvincia = :idProvince;";
            $this->db->query($sql);

            $this->db->bind(":idProvince", $data['idProvince']);
            
            $cantons = $this->db->results();
            ?> 
                <option value="">Cantones</option>
            <?php
            foreach($cantons  as $canton){ ?>
                <option value="<?php echo $canton->idCanton ?>"> <?php echo $canton->nombreCanton; ?> </option>
            <?php }
        }

        // METODO PARA CARGAR LOS MENU PARA EL FORMULARIO
         private function loadFormSelectMenu($data){
            $sql = "SELECT idComida, nombreComida, precioComida FROM menu";
            $this->db->query($sql);
            $menu = $this->db->results();
            foreach($menu  as $food){ ?>
                <option value="<?php echo $food->idComida ?>"> <?php echo $food->nombreComida; ?> </option>
            <?php }
        }
        


    }


    $initClass = new Ajax;

?>