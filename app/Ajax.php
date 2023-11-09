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
                
                $this->generateBill($this->db->inserted_id());

                return $this->ajaxRequestResult(true, "Se ha guardar la factura");
            }

        }

        // metodo para la generacion de la factura
        private function generateBill($idBill){

            // generar archivo de factura y descargarlo en la pc
            $sql = "SELECT idFactura, nombreEvento, precioEvento, cantAsistentes, duracion, nombreCanton, precioCanton, nombreProvincia, nombreComida, precioComida, pirotecnia from facturas";
            $sql .= " INNER JOIN eventos ON eventos.idEvento = facturas.idEvento";
            $sql .= " INNER JOIN cantones ON cantones.idCanton = facturas.idCanton";
            $sql .= " INNER JOIN provincias ON provincias.idProvincia = cantones.idProvincia";
            $sql .= " INNER JOIN menu ON menu.idComida = facturas.idComida";
            $sql .= " WHERE idFactura = :idBill";

            $this->db->query($sql);
            $this->db->bind(':idBill', $idBill);
            $bill = $this->db->result();

            $bill['priceHour'] = 1200;
            $bill['pricePyrotechnics'] = 5000;

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

        // --------------------------------- METODOS PARA EL AREA DE ADMINISTRACION -------------------------------------

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

        // METODO PARA CERRAR SESION DEL ADMINSITRADOR
        private function adminLogout($data){
            session_unset(); 
            session_destroy();
            return $this->ajaxRequestResult(true, "Se ha cerrado sesión");
            
        }


        // ---------------------------------------- FACTURAS
        // cargar la tabla de facturas
        private function loadBillsDataTable($REQUEST){
            // datatable column index  => database column name
            $columns = array(0 => 'idFactura', 1 => 'nombreEvento', 2 => 'cantAsistentes', 3 => 'duracion', 4 => 'nombreCanton', 5 => 'nombreComida', 6 => 'pirotecnia');
            //Columnas para realizar la busqueda en cada datatable
            $search = array( 0 => 'idFactura', 1 => 'nombreEvento',  2 => 'nombreCanton', 3 => 'nombreComida');
            // Estructura de la consulta inicial
            $sql = "SELECT idFactura, nombreEvento, precioEvento, cantAsistentes, duracion, nombreCanton, precioCanton, nombreProvincia, nombreComida, precioComida, pirotecnia from facturas";
                $sql .= " INNER JOIN eventos ON eventos.idEvento = facturas.idEvento";
                $sql .= " INNER JOIN cantones ON cantones.idCanton = facturas.idCanton";
                $sql .= " INNER JOIN provincias ON provincias.idProvincia = cantones.idProvincia";
                $sql .= " INNER JOIN menu ON menu.idComida = facturas.idComida";

            $this->db->query($sql);
            $totalRecords = $this->db->countRows($sql);
            $draw = intval($REQUEST["draw"]);
            // se realiza la consulta a la base de datos
            $result = $this->getQueryDataTables($REQUEST, $sql, $columns, $search);

            $data = array(); // se crea el array para guardar los datos
            foreach($result['queryResult'] as $row){
                $row = get_object_vars($row);
                $btnDownload = "<button type='button' class='btn btn-warning btn-sm' data-download-bill='".$row['idFactura']."'><i class='fa-solid fa-download'></i></button>";
                $btnPass = "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modal-default' data-modal='admin-pass?".$row['idFactura']."'><i class='fas fa-lock'></i></button>";

                $sub_array = array();
                $sub_array['idFactura'] = $row['idFactura'];
                $sub_array['nombreEvento'] = $row['nombreEvento'];
                $sub_array['asistentes'] = $row['cantAsistentes'];
                $sub_array['duracion'] = $row['duracion'];
                $sub_array['canton'] = $row['nombreProvincia'] .", ". $row['nombreCanton'];
                $sub_array['menu'] = $row['nombreComida'];
                $sub_array['pirotecnia'] = $row['pirotecnia'] == 1 ? "Sí" : "No";
                $sub_array['actions'] = $btnDownload;
                $data[] = $sub_array;
            }
            echo $this->dataTableOutput($draw, $result['totalFiltered'], $totalRecords, $data);
        }
        
        private function generateAdminBill($data){

            $this->generateBill($data['idBill']);
            return $this->ajaxRequestResult(true, "Se ha generado la factura");
        }

        // ---------------------------------------- USUARIOS    
        private function loadUsersDataTable($REQUEST){
            // datatable column index  => database column name
            $columns = array(0 => 'nombre', 1 => 'correo');
            //Columnas para realizar la busqueda en cada datatable
            $search = array( 0 => 'nombre', 1 => 'correo');
            // Estructura de la consulta inicial
            $sql = "SELECT correo, nombre FROM usuarios";

            $this->db->query($sql);
            $totalRecords = $this->db->countRows($sql);
            $draw = intval($REQUEST["draw"]);
            // se realiza la consulta a la base de datos
            $result = $this->getQueryDataTables($REQUEST, $sql, $columns, $search);

            $data = array(); // se crea el array para guardar los datos
            foreach($result['queryResult'] as $row){
                $row = get_object_vars($row);
                $btnEdit = "<button type='button' class='btn btn-warning btn-sm'><i class='fas fa-pen'></i></button>";
                $btnPass = "<button type='button' class='btn btn-primary btn-sm'><i class='fas fa-lock'></i></button>";

                $sub_array = array();
                $sub_array['username'] = $row['nombre'];
                $sub_array['email'] = $row['correo'];
                $sub_array['actions'] = $btnEdit ." ". $btnPass;
                $data[] = $sub_array;
            }
            echo $this->dataTableOutput($draw, $result['totalFiltered'], $totalRecords, $data);
        }
        

        // ---------------------------------------- EVENTOS    
        private function loadEventsDataTable($REQUEST){
            // datatable column index  => database column name
            $columns = array(0 => 'idEvento', 1 => 'nombreEvento', 2 => 'precioEvento');
            //Columnas para realizar la busqueda en cada datatable
            $search = array( 0 => 'idEvento', 1 => 'nombreEvento', 2 => 'precioEvento');
            // Estructura de la consulta inicial
            $sql = "SELECT idEvento, nombreEvento, precioEvento FROM eventos";

            $this->db->query($sql);
            $totalRecords = $this->db->countRows($sql);
            $draw = intval($REQUEST["draw"]);
            // se realiza la consulta a la base de datos
            $result = $this->getQueryDataTables($REQUEST, $sql, $columns, $search);

            $data = array(); // se crea el array para guardar los datos
            foreach($result['queryResult'] as $row){
                $row = get_object_vars($row);
                $btnEdit = "<button type='button' class='btn btn-warning btn-sm'><i class='fas fa-pen'></i></button>";
                $btnDelete = "<button type='button' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></button>";

                $sub_array = array();
                $sub_array['idEvent'] = $row['idEvento'];
                $sub_array['nameEvent'] = $row['nombreEvento'];
                $sub_array['priceEvent'] = $row['precioEvento'];
                $sub_array['actions'] = $btnEdit ." ". $btnDelete;
                $data[] = $sub_array;
            }
            echo $this->dataTableOutput($draw, $result['totalFiltered'], $totalRecords, $data);
        }

        // ---------------------------------------- MENU    
        private function loadMenuDataTable($REQUEST){
            // datatable column index  => database column name
            $columns = array(0 => 'idComida', 1 => 'nombreComida', 2 => 'precioComida');
            //Columnas para realizar la busqueda en cada datatable
            $search = array( 0 => 'idComida', 1 => 'nombreComida', 2 => 'precioComida');
            // Estructura de la consulta inicial
            $sql = "SELECT idComida, nombreComida, precioComida FROM menu";

            $this->db->query($sql);
            $totalRecords = $this->db->countRows($sql);
            $draw = intval($REQUEST["draw"]);
            // se realiza la consulta a la base de datos
            $result = $this->getQueryDataTables($REQUEST, $sql, $columns, $search);

            $data = array(); // se crea el array para guardar los datos
            foreach($result['queryResult'] as $row){
                $row = get_object_vars($row);
                $btnEdit = "<button type='button' class='btn btn-warning btn-sm'><i class='fas fa-pen'></i></button>";
                $btnDelete = "<button type='button' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></button>";

                $sub_array = array();
                $sub_array['idFood'] = $row['idComida'];
                $sub_array['nameFood'] = $row['nombreComida'];
                $sub_array['priceFood'] = $row['precioComida'];
                $sub_array['actions'] = $btnEdit ." ". $btnDelete;
                $data[] = $sub_array;
            }
            echo $this->dataTableOutput($draw, $result['totalFiltered'], $totalRecords, $data);
        }

        // --------------------------------- DATATABLES METHODS -------------------------------------

        // obtener los datos para el  datatables
        private function getQueryDataTables($requestData, $sql, $columns, $search, $where = false){
            // obtenemos la clausua para el where
            if($where){
                $sql .= ' WHERE ';
                $lengthWhere = count($where); // obtenemos el tamano del array 
                $i = 0;
                foreach($where as $column => $value){
                    $sql .= $column.' = '.$value.'';
                    $sql .= ++$i === $lengthWhere ? "" : " AND";
                }
            }
            
            if(!empty($requestData['search']['value']) && $requestData['search']['value'] != ""){
                $sql .= !$where ? ' WHERE ' : ' AND ';
                $length = count($search); // obtenemos el tamano del array 
                $i = 0;
                foreach($search as $key => $column){
                    $sql .= $column.' LIKE "%'.$requestData["search"]["value"].'%"';
                    $sql .= ++$i < $length ? " OR " : "";
                }
            }
            //OBTENEMOS LA CLAUSULA DEL ORDER
            if(isset($requestData["order"])){
                $sql .= ' ORDER BY '.$columns[$requestData['order'][0]['column']].' '.$requestData['order'][0]['dir'];
            }else{
                $sql .= ' ORDER BY '.$columns[0].' ASC';
            }
            if($requestData["length"] != -1){
                $sql .= ' LIMIT ' . $requestData['start'] . ', ' . $requestData['length'];
            }
            
            $this->db->query($sql);
            $totalFiltered = $this->db->countRows();
            $query =$this->db->results();
    
            $result = array(
                'sql' => $sql,
                'queryResult' => $query,
                'totalFiltered' => $totalFiltered
            );
            
            return $result;
        }
        
        //Params: Draw, TotalFiltrados, TotalRecords, Datos
        //Result: un array codificado en formato json
        //Prepara los datos de la consulta hecha y los ordena para ser leidos por las dataTables
        public function dataTableOutput($draw, $totalFiltered, $totalRecords, $data){
            // $output = array();
            $output = array(
                "draw"				=>	$draw,
                "recordsTotal"      =>  $totalFiltered,  // total number of records
                "recordsFiltered"   =>  $totalRecords, // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data"				=>  $data
            );
        
            return json_encode($output);
        }


    }


    $initClass = new Ajax;

?>