<?php

	namespace App\Khan\Component\Socket;

	set_time_limit(0);

	class Socket {

		private static $instance = null;
		private static $endpoint = "http://khan-socket-server.fr.openode.io/socket";

		public static function init(){
			if(is_null(self::$instance)){
				self::$instance = new Socket();
			}
			return self::$instance;
		}

		protected function __construct(){}

		public static function curl($data){
			$ch = curl_init(self::$endpoint);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			if(curl_errno($ch)){
				echo 'Curl error: '. curl_error($ch);
			}
			curl_close($ch);
			return $result;
		}

		public static function emit($chanell, $data){

			$post = http_build_query([
				$chanell => json_encode($data)
			]);

			try {

				if(function_exists('http_post_data')){
					http_post_data(self::$endpoint, $post);
					http_response_code(200);
					echo "success";
				}else{
					Socket::curl($post);
					http_response_code(200);
					echo "success";
				}

			} catch (Exception $e) {

				die("Error {$e->getMessage()}");

			}

		}

	}
