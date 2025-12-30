<?php

if (!function_exists('view')) {
    function view($viewName, $data = []) {
        extract($data);
        // Ana dizine çıkmak için dirname(__DIR__) kullanıyoruz
        $path = dirname(__DIR__) . "/app/Views/" . $viewName . ".php";

        if (file_exists($path)) {
            ob_start();
            include $path;
            return ob_get_clean();
        }
        return "Görünüm dosyası bulunamadı: " . $path;
    }
}