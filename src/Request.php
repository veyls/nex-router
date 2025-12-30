<?php

namespace Nex;

class Request {
    // URL yolunu döndürür (/yazi/1 gibi)
    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = str_replace('/nex-router/public', '', $path); // Alt klasörü temizle
        $position = strpos($path, '?');
        return $position === false ? $path : substr($path, 0, $position);
    }

    // İstek tipini döndürür (GET veya POST)
    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    // Formlardan gelen verileri temizleyerek alır
    public function getBody() {
        $body = [];
        $method = $this->getMethod();
        $source = ($method === 'get') ? INPUT_GET : INPUT_POST;

        foreach (($method === 'get' ? $_GET : $_POST) as $key => $value) {
            $body[$key] = filter_input($source, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }
}