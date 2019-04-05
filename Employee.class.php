<?php

    class Employee{
        private $id;
        private $nombre;
        private $sueldo;
        private $curriculum;
        private $imagen;

        public function getId(){
            return $this->id;
        }

        public function setId($v_id){
            $this->id = $v_id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($v_nombre){
            $this->nombre = $v_nombre;
        }

        public function getSueldo(){
            return $this->sueldo;
        }

        public function setSueldo($v_sueldo){
            $this->sueldo = $v_sueldo;
        }

        public function getCurriculum(){
            return $this->curriculum;
        }

        public function setCurriculum($v_curriculum){
            $this->curriculum = $v_curriculum;
        }

        public function getImagen(){
            return $this->imagen;
        }

        public function setImagen($v_imagen){
            $this->imagen = $v_imagen;
        }
    }

?>