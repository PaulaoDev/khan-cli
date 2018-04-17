<?php

	namespace App\Khan\Libraries;
	use App\Khan\Contracts\Libraries\Libraries as LibrariesContract;

	@session_start();

	class Session implements LibrariesContract {

		protected static $instance = null;

		public static function create(){
            if(is_null(self::$instance)){
                self::$instance = new Session();
            }
            return self::$instance;
        }

        protected function __construct(){}

		public static function has($name){
			if(isset($_SESSION[$name]) && !empty($_SESSION[$name])){
				return true;
			}
		}

		public static function set($name, $value){
			if(!isset($_SESSION[$name]) && empty($_SESSION[$name])){
				$_SESSION[$name] = $value;
			}
		}

		public static function get($name){
			if(isset($_SESSION[$name]) && !empty($_SESSION[$name])){
				return $_SESSION[$name];
			}
		}

		public static function remove($name){
			if(isset($_SESSION[$name]) && !empty($_SESSION[$name])){
				unset($_SESSION[$name]);
			}
		}

		public static function removeAll(){
			session_destroy();
		}

	}
