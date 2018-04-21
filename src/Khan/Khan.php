<?php

	/**
	 * RouterKhan (Khan.php) - A fast, easy and flexible router system for PHP
	 *
	 * @author      PaulaoDev <jskhanframework@gmail.com>
	 * @copyright   (c) PaulaoDev
	 * @link        https://github.com/PaulaoDev/router-khan
	 * @license     MIT
	 */

	namespace App\Khan;

	use App\Khan\Component\Router\src\Router\Router as Router;
	use App\Khan\Component\Container\ServiceContainer as Container;
	use App\Khan\Component\Stream\StreamServer as Stream;
	use App\Khan\Component\DB\DB as Conn;

	/**
	 * Class Core Run Project
	 */

	class Khan {

	    protected static $instance = null;

	    /**
	     * [create get instance in singleton]
	     * @return [object] [Return khan instance]
	     */
	    public static function create(){
	        if (self::$instance == null) {
	            self::$instance = new Khan();
	        }
	        return self::$instance;
	    }

	    protected function __construct(){}

	    /**
	     * [enviroments $_ENV]
	     * @return [void] [load enviroments in system]
	     */
	    private function enviroments(){
	        $this->dotenv = new \Dotenv\Dotenv(ROOT_FOLDER);
	        $this->dotenv->load();
	    }

	    /**
	     * [setDb set Database]
	     */
	    private function setDb(){
	    	$this->db = function () {
	            return Conn::getConn($_ENV);
	        };
	    }

	    /**
	     * [setContainer container injection service]
	     */
	    private function setContainer(){
	    	$this->container = Container::create();
	    }

	    /**
	     * [router run router system]
	     * @return [void] [define router system]
	     */
	    protected function router(){

	        $container = $this->container;
	        $stream = new Stream();
	        $db = $this->db;

	        Router::create([
	            "clean_request" => true,
	            "url_filter" => true
	        ]);

	        $router = Router::create();

	        include_once __DIR__ . '/Component/Functions/Functions.php';

	        foreach (glob("routes/*.php") as $filename) {
	            include_once $filename;
	        }

	        $routerFactory = Router::create();
	        $routerFactory->dispatch();

	    }

	    /**
	     * [services Load all services]
	     * @return [void [load and run services in framework]
	     */
	    public function services(){

	        $this->enviroments();
	        $this->setDb();
	        $this->setContainer();
	        $this->router();

	    }

	    public function dispatch(){

	        $this->services();

	    }
	    
	}
