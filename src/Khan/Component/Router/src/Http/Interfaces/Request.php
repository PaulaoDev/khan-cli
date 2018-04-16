<?php

	namespace App\Khan\Component\Router\src\Http\Interfaces;

	interface Request {
    
			public function get($key, $default);
			public function getSession();
			public function hasPreviousSession();
			public function hasSession();
			public function getClientIps();
			public function getClientIp();
			public function getScriptName();
			public function getPathInfo();
			public function getBasePath();
			public function getBaseUrl();
			public function getScheme();
			public function getPort();
			public function getUser();
			public function getPassword();
			public function getUserInfo();
			public function getHttpHost();
			public function getRequestUri();
			public function getSchemeAndHttpHost();
			public function getUri();
			public function getUriForPath($path);
			public function getRelativeUriForPath($path);
			public function getQueryString();
			public function isSecure();
			public function getHost();
			public function setMethod($method);
			public function getMethod();
			public function getRealMethod();
			public function getMimeType($format);
			public static function getMimeTypes($format);
			public function getFormat($mimeType);
			public function setFormat($format, $mimeTypes);
			public function getRequestFormat($default);
			public function setRequestFormat($format);
			public function getContentType();
			public function setDefaultLocale($locale);
			public function getDefaultLocale();
			public function setLocale($locale);
			public function getLocale();
			public function isMethod($method);
			public function isMethodSafe(/* $andCacheable = true */);
			public function isMethodIdempotent();
			public function isMethodCacheable();
			public function getContent($asResource);
			public function getETags();
			public function isNoCache();
			public function getPreferredLanguage();
			public function getLanguages();
			public function getCharsets();
			public function getEncodings();
			public function getAcceptableContentTypes();
			public function isXmlHttpRequest();
			public function isFromTrustedProxy();
			public static function post();
			public static function put();
			public static function delete();
			public static function params();
			public static function session();
    
	}
