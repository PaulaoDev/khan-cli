<?php
    
    use \App\Khan\Component\Mime\Mime as Mime;

    $router::respond('/public/(.*)', function ($req, $res, $db, $reg) {
        $fileDir = "public/{$reg[1]}";
        if (file_exists($fileDir)) {
            $mime = Mime::get($fileDir);
            header("Content-type: {$mime}", true);
            return file_get_contents($fileDir);
        } else {
            http_response_code(404);
        }
    });

    $router::respond('/docs/(.*)', function ($req, $res, $db, $reg) {
        $fileDir = "docs/{$reg[1]}";
        if (file_exists($fileDir)) {
            $mime = Mime::get($fileDir);
            header("Content-type: {$mime}", true);
            return file_get_contents($fileDir);
        } else {
            http_response_code(404);
        }
    });
