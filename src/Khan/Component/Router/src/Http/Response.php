<?php
	
	namespace App\Khan\Component\Router\src\Http;
	use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
  	use \App\Khan\Component\Router\src\Http\Interfaces\Response as ResponseInterface;

	/**
	* Response Class and Interface Implement
	*/

	class Response extends SymfonyResponse implements ResponseInterface{

		public static $extends = [
			"view",
			"assets",
			"socket"
		];
    
		private static $use = [];
    
		public function __construct($uses){

			parent::__construct();
			self::$use = $uses;
			$this->loadTwig($uses);
			$this->extendsTwig();
			foreach(self::$use as $key => $value){
				if(preg_match("/twig\./i", $key)){
					$fnName = str_replace('twig.', '', $key);
					$this->setFunctionTwig($fnName, $value);
				}else{
					$this->$key = $value;
				}
			}

		}

		public function loadTwig($uses){
			$folder = (!isset($uses['views'])) ? 'resources/views/' : $uses['views'];
			$loader = new \Twig_Loader_Filesystem($folder);
			$cache = ($_ENV['APP_PRODUCTION'] === 'true') ? ['cache' => $folder . 'compilation_cache'] : [];
			$this->twig = new \Twig_Environment($loader, $cache);
		}

		public function setFunctionTwig($fname, $fncall = false){
			$self = $this;
			$function = new \Twig_SimpleFunction($fname, function() use($self, $fname, $fncall){
					if($fncall === false){
						call_user_func_array([$self, $fname], func_get_args());
					}else{
						call_user_func_array($fncall, func_get_args());
					}
				});
			$this->twig->addFunction($function);
		}

		public function extendsTwig(){
			foreach (self::$extends as $key => $extend) {
				$this->setFunctionTwig($extend);
			}
		}

		public function socket($dev = true){

			$res = "<script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.slim.js' charset='utf-8'></script>";

			if($dev){
				$res .= "\n    <script src='https://rawgit.com/PaulaoDev/khan/master/src/Khan/Component/Socket/SocketAdpter.js' charset='utf-8'></script>";
			}else{
				$res .= "\n    <script src='https://cdn.rawgit.com/PaulaoDev/khan/master/src/Khan/Component/Socket/SocketAdpter.js' charset='utf-8'></script>";
			}

			echo $res;

		}

		public function view($name){
			echo 'resources/views/' . $name;
		}

		public function assets($name){
			echo $_ENV['APP_URL'] . "/" . "public/" . $name;
		}
		
		public function render($file, $data = []){
			echo $this->twig->render($file, $data);
		}

		public function load($file){
			return $this->twig->load($file);
		}
		
		public function send($string = ''){
			echo $string;
		}
    
	}
