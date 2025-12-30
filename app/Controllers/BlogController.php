<?php

namespace App\Controllers;

use Nex\Request;
use Nex\Response;

class BlogController {
    
    private $yazilar = [
        1 => ['baslik' => 'Next.js ve PHP', 'icerik' => 'Harika bir ikili!', 'yazar' => 'Ali'],
        2 => ['baslik' => 'NexRouter V1', 'icerik' => 'Final sürümü bitti.', 'yazar' => 'Veli']
    ];

    public function anaSayfa(Request $request, Response $response) {
        return view('home', [
            'title' => 'NexRouter Blog',
            'yazilar' => $this->yazilar
        ]);
    }

    public function yazi(Request $request, Response $response, $id) {
        if (!isset($this->yazilar[$id])) {
            $response->setStatusCode(404);
            return "Yazı bulunamadı.";
        }
        
        $yazi = $this->yazilar[$id];
        return "<h1>{$yazi['baslik']}</h1><p>{$yazi['icerik']}</p>";
    }
}