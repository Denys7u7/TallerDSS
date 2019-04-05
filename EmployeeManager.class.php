<?php
class EmployeeManager{

    private function mostrarFormulario($Id,$Nombre,$Sueldo){
        echo <<<EOF
        <form method="POST" action="" enctype="multipart/form-data">
            <p>Registrar un empleado</p>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="id" name="id" value="$Id" required/>
                <label class="mdl-textfield__label" for="id">ID</label>
            </div><br>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="nombre" name="nombre" value="$Nombre" required/>
                <label class="mdl-textfield__label" for="nombre">Nombre</label>
            </div><br>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" step="0.01" min="0" id="sueldo" name="sueldo" value="$Sueldo" required/>
                <label class="mdl-textfield__label" for="sueldo">Sueldo</label>
            </div><br>
            <label for="imagen"><span><i class="fas fa-file-image"></i> Imagen</span></label>

            <input type="file" name="imagen" id="imagen" accept=".png,.jpg" required>
            <label for="curriculum"><span><i class="fas fa-file-pdf"></i> Curriculum</span></label>
            <input type="file" name="curriculum" id="curriculum" accept=".pdf" required><br>
            <input type="submit" id="enviar" name="enviar" value="Registrar">
        </form>
EOF;
    }

    private function csv_to_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
        $data = array();
        if (($archivo = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($archivo, 1000, $delimiter)) !== FALSE)
            {
                    $data[] = $row;
            }
            fclose($archivo);
        }
        return $data;
    }

    function guardarEmpleado($empleado){
        if(isset($_POST['enviar'])){
            $empleadosRegistrados[] = null;
            $msj = null;
            if (file_exists("empleados.dat") and is_readable("empleados.dat")){
                $empleadosRegistrados = $this->csv_to_array("empleados.dat",",");
            }

            $empleado->setId($_POST["id"]);
            $empleado->setNombre($_POST["nombre"]);
            $empleado->setSueldo($_POST["sueldo"]);
            if ($empleadosRegistrados != null){
                foreach($empleadosRegistrados as $empleadoR){
                    if($empleadoR[0] == $empleado->getId()){
                        $msj = "El id ya esta registrado";
                    }
                }
            }
            if($empleado->getSueldo() < 300){
                $msj = "El sueldo no puede ser menor a $300";
            }
            $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
            for ($i=0; $i<strlen($empleado->getNombre()); $i++){ 
                if (strpos($permitidos, substr($empleado->getNombre(),$i,1))===false){ 
                    $msj = "El nombre no puede contener valores numericos";
                } 
            }
            $nombre_imagen = $_FILES['imagen']['name'];
            $extension_img = new SplFileInfo($nombre_imagen);
            $extension_img = $extension_img->getExtension();
            if ($extension_img != 'png' AND $extension_img != 'jpg'){
                $msj = "La imagen solo puede ser extension .png o .jpg";
            }
            $nombre_curriculum = $_FILES['curriculum']['name'];
            $extension_pdf = new SplFileInfo($nombre_curriculum);
            $extension_pdf = $extension_pdf->getExtension();
            if ($extension_pdf != 'pdf'){
                $msj = "El curriculum debe de ser extension .pdf";
            }
            if ($msj != null){
                $this->mostrarFormulario($_POST['id'],$_POST['nombre'],$_POST['sueldo']);
                echo "<div class='mensaje'>";
                echo "<p>$msj</p>";
                echo "</div>";
                $msj = null;
                return;
            }
            $empleado->setImagen($empleado->getId().".".$extension_img);
            $empleado->setCurriculum($empleado->getId().".".$extension_pdf);
            $tipo_imagen = $_FILES['imagen']['type'];
            $tamanio_imagen = $_FILES['imagen']['size'];
            $destino = $_SERVER['DOCUMENT_ROOT'] . '/DSS_Taller_2/subidas/';
            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino.$empleado->getImagen());
            
            $tipo_curriculum = $_FILES['curriculum']['type'];
            $tamanio_curriculum = $_FILES['curriculum']['size'];
            $destino = $_SERVER['DOCUMENT_ROOT'] . '/DSS_Taller_2/subidas/';
            move_uploaded_file($_FILES['curriculum']['tmp_name'], $destino.$empleado->getCurriculum());
            
            $archivo = fopen("empleados.dat", "a+");
            fputs($archivo,$empleado->getId().",");
            fputs($archivo,$empleado->getNombre().",");
            fputs($archivo,$empleado->getSueldo().",");
            fputs($archivo,$empleado->getImagen().",");
            fputs($archivo,$empleado->getCurriculum()."\n");
            fclose($archivo);
        }else{
            $this->mostrarFormulario("","","");
        }
    }

}
    



?>