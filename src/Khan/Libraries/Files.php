<?php

    namespace App\Khan\Libraries;
    use App\Khan\Contracts\Libraries\Libraries as LibrariesContract;

    class Files implements LibrariesContract {

        protected static $instance = null;

        public static function create(){
            if(is_null(self::$instance)){
                self::$instance = new Files();
            }
            return self::$instance;
        }

        protected function __construct(){}

        public function isType(array $file, string $type){
            return $file["type"] === "image/".$type;
        }

        public function sizeMax($size, $file){
            return ($size * 1000000) > $file["size"];
        }

        public function exists($dir, $file, $encrypt = false){
            $name = $file["name"];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if ($encrypt) {
                $name = md5($name).".".$ext;
            }
            $filename = $dir.'/'.$name;
            return file_exists($filename);
        }

        public function move($file, $dir, $encrypt = false){

            $name = $file["name"];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $temp = $file["tmp_name"];

            if ($encrypt) {
                $name = md5($name).".".$ext;
            }

            $filename = $dir.'/'.$name;

            if (move_uploaded_file($temp, $filename)) {
                return $filename;
            }

            return false;

        }

    }
