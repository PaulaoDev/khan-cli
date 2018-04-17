<?php

    namespace App\Khan\Libraries;
    use App\Khan\Contracts\Libraries\Libraries as LibrariesContract;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

	class Mail implements LibrariesContract {

		protected static $instance = null;

		public static function create(){
            if(is_null(self::$instance)){
                self::$instance = new Mail();
            }
            return self::$instance;
        }

        protected function __construct(){
        	$this->mail = new PHPMailer(true);
	        return $this->mail;
        }

	}
