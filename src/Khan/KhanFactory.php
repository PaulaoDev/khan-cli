<?php

	namespace App\Khan;
	
	use App\Khan\Khan as Khan;

	/**
	 * Create khan class in factory
	 */
	class KhanFactory {

		public static function create(){
        	return Khan::create();
    	}

	}
