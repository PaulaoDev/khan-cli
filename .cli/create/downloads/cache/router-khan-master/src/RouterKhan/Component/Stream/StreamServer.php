<?php
	
	namespace App\RouterKhan\Component\Stream;

	class StreamServer{

		public function RunStream($ext, $type, $file){

			try {
				header("Content-Type: {$type}");
			 	header("Cache-Control: no-cache");
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: ".filesize($file));
				header("Accept-Ranges: bytes");
				readfile($file);
			} catch (Exception $e) {
				echo "Ocorreu um erro no Stream: ".$e->getMessage();
			}

		}

		public function CreateStream($file = false){

			if($file && file_exists($file)){

				$ext = pathinfo($file, PATHINFO_EXTENSION);
				$mimetype = mime_content_type($file);
				$this->RunStream($ext, $mimetype, $file);

			}

		}

	}
