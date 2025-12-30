<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Nex\Router;

// Ana Sayfa
Router::get('/', 'BlogController@anaSayfa');

// DİNAMİK ROTA: Klasör yapmaya gerek bırakmayan satır
Router::get('/yazi/[id]', 'BlogController@yazi');

Router::run();