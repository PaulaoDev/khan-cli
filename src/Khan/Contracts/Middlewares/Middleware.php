<?php

	namespace App\Khan\Contracts\Middlewares;

	interface Middleware {

		public static function handle($req, $res, \Closure $next);

	}
