<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//function() e funcao anonima, executada quando chamada a rota
//get e funcao estatica de Route
Route::get('/', function () {
    return "<h1>LARAVEL</h1>";
});

Route::get('/ola', function () {
    return "<h1>SEJA BEM VINDO!</h1>";
});

Route::get('/ola/sejabemvindo', function () {
    //return "<h1>OLA VISITANTE, SEJA BEM VINDO</h1>";
    return view("welcome");
});

//{nome} e parametro
//passar parâmetros para as rotas
/*Route::get('/nome/{nome}', function ($nome) {

    return "<h1>Ola, $nome!</h1>";
});*/

//nomes podem ser diferentes, apenas passará na ordem
Route::get('/nome/{nome}/{sobrenome}', function ($nome, $sn) {

    return "<h1>Ola, $nome $sn!</h1>";
});

//3 niceis, se nao recebe-los vai crachar
//por enquanto nao filtra o tipo de dado que pode receber, apenas o $n
Route::get('/repetir/{nome}/{n}', function ($nome, $n) {

    if(is_integer($n)){
        for($i=0 ; $i<$n ; $i++){
            echo "<h1>Ola, $nome!</h1>";
        }
    } else{
        echo "Voce nao digitou um inteiro!";
    }
});