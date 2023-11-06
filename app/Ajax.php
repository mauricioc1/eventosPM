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
            // inicializacion de la sesion
            session_start();
            
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
                <option value="<?php echo $event->idEvento ?>" data-price="<?php echo $event->precioEvento; ?>"> <?php echo $event->nombreEvento; ?> </option>
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
                <option value="" data-price="0">Cantones</option>
            <?php
            foreach($cantons  as $canton){ ?>
                <option value="<?php echo $canton->idCanton ?>" data-price="<?php echo $canton->precioCanton; ?>"> <?php echo $canton->nombreCanton; ?> </option>
            <?php }
        }

        // METODO PARA CARGAR LOS MENU PARA EL FORMULARIO
         private function loadFormSelectMenu($data){
            $sql = "SELECT idComida, nombreComida, precioComida FROM menu";
            $this->db->query($sql);
            $menu = $this->db->results();
            foreach($menu  as $food){ ?>
                <option value="<?php echo $food->idComida ?>" data-price="<?php echo $food->precioComida; ?>"> <?php echo $food->nombreComida; ?> </option>
            <?php }
        }


        // METODO PARA EL INICIO DEL ADMINISTRADOR
        private function adminLogin($data){
            $sql = "SELECT correo FROM usuarios WHERE correo = :correo AND contrasena = :pass;";
            $this->db->query($sql);
            $this->db->bind(":correo", $data['email']);
            $this->db->bind(":pass", $data['pass']);

            
            if($this->db->countRows() !== 1){
                return $this->ajaxRequestResult(false, "Datos incorrectos");
            }else{
                $_SESSION['ADMIN'] = true;

                return isset($_SESSION['ADMIN']) ? $this->ajaxRequestResult(true, "Se ha iniciado sesion") : $this->ajaxRequestResult(false, "Error al iniciar sesion") ;
            }
            
        }
        
        // metodo para guardar la factura en la base de datos y generar la factura
        private function saveBill($bill){
            $sql = "INSERT INTO facturas (idEvento, cantAsistentes, duracion, idCanton, idComida, pirotecnia) ";
            $sql .= "VALUES (:idEvent, :guests, :hours, :idCanton, :idFood, :pirotechnics);";

            $this->db->query($sql);
            // bind de los valores
            foreach($bill as $bind => $value){
                $this->db->bind($bind, $value);
            }

            if(!$this->db->execute()){
                return $this->ajaxRequestResult(false, "Error al guardar la factura");
            }else{

                // generar archivo de factura y descargarlo en la pc
                $bill[':idBill'] =  $this->db->inserted_id();
                $sql = "SELECT idFactura, nombreEvento, precioEvento, cantAsistentes, duracion, nombreCanton, precioCanton, nombreProvincia, nombreComida, precioComida, pirotecnia from facturas";
                $sql .= " INNER JOIN eventos ON eventos.idEvento = facturas.idEvento";
                $sql .= " INNER JOIN cantones ON cantones.idCanton = facturas.idCanton";
                $sql .= " INNER JOIN provincias ON provincias.idProvincia = cantones.idProvincia";
                $sql .= " INNER JOIN menu ON menu.idComida = facturas.idComida";
                $sql .= " WHERE idFactura = :idBill";

                $this->db->query($sql);
                $this->db->bind(':idBill', $bill[':idBill']);
                $newBill = $this->db->result();

                $newBill['priceHour'] = 1200;
                $newBill['pricePyrotechnics'] = 5000;
                
                $this->generateBill($newBill);

                return $this->ajaxRequestResult(true, "Se ha guardar la factura");
            }

        }

        // metodo para la generacion de la factura
        private function generateBill($bill){
            require 'invoice.php';
        }

        // metodo que dada una factura le calcula el total
        private function totalBill($bill){
            $totalBillPrice = 0;
            
            $totalBillPrice += $bill['precioEvento'];
            $totalBillPrice += $bill['precioCanton'];
            $totalBillPrice += $bill['duracion'] * $bill["priceHour"];
            $totalBillPrice += $bill['cantAsistentes'] * $bill["precioComida"];
            $totalBillPrice += $bill['pirotecnia'] ? $bill['pricePyrotechnics'] : 0;

            return $totalBillPrice;
        }

    }


    $initClass = new Ajax;

?>