<?php

use Illuminate\Http\Request;

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

Route::get('/seunomecomregra/{nome}/{n}', function ($nome, $n) {

    //n recebe somente 0 a 9 (nao e intervalo mas sim digitos possiveis)
    for($i=0 ; $i<$n ; $i++){
        echo "<h1>Ola, $nome! ($i) </h1>";
    }
//+ para poder ter mais que um digito
//expressao regular
//nome aceita apenas caracteres de 'a' a 'z' minusculo ou maiusculo
})->where('n','[0-9]+')->where('nome','[A-Za-z]+');

//restringindo menos, parametro nome e opcional
//padrao e null
Route::get('/seunomesemregra/{nome?}', function ($nome=null) {

    if(isset($nome)){
        echo "<h1>Ola, $nome!</h1>";
    } else{
        echo "Voce nao passou nenhum nome!";
    }
});

//agrupamento de rotas
//app e base
Route::prefix('app')->group(function (){

    Route::get("/", function(){
        return "Pagina Principal do APP";
    });

    Route::get("profile", function(){
        return "Pagina profile";
    });

    Route::get("about", function(){
        return "Meu about";
    });
});

//redirecionamento, /aqui vai para /ola
//301 e codigo de retorno do http, foi permanentemente movido para outra rota
//funcionou apenas pelo php artisan serve
Route::redirect('/aqui', '/ola', 301);

//redirecionar para views
/*Route::get('/hello', function () {
    return view('hello');
});*/

Route::view('/hello', 'hello');

//passando parametros
//rota, view
//array associativo
Route::view('/viewnome', 'hellonome',
    ['nome'=>'Joao',
    'sobrenome'=>'Silva']);

//parametros da url
Route::get('/hellonome/{nome}/{sobrenome}', function ($nome, $sn){

    return view('hellonome',
        ['nome'=>$nome, 'sobrenome'=>$sn]);
});

Route::get('/rest/hello', function (){

    return "Hello (GET)";
});

Route::post('/rest/hello', function (){

    return "Hello (POST)";
});

Route::delete('/rest/hello', function (){

    return "Hello (DELETE)";
});

Route::put('/rest/hello', function (){

    return "Hello (PUT)";
});

Route::patch('/rest/hello', function (){

    return "Hello (PATCH)";
});

Route::options('/rest/hello', function (){

    return "Hello (OPTIONS)";
});

//passar parametro, formulario
Route::post('/rest/imprimir', function (Request $req){
    $nome = $req->input('nome');
    $idade = $req->input('idade');
    return "Hello $nome ($idade)! (POST)";
});

//agrupar varios metodos a serem atendidos por mesma funcao anonima
Route::match(['get','post'],'/rest/hello2', function (){
   return "Hello World 2";
});

//atende qualquer metodo
Route::any('/rest/hello3', function (){
    return "Hello World 3";
});

//nomeando rota
Route::get('/produtos', function(){

    echo "<h1>Produtos</h1>";
    echo "<ol>";
    echo "<li>Notebook</li>";
    echo "<li>Impressora</li>";
    echo "<li>Mouse</li>";
    echo "</ol>";
})->name('meusprodutos');

//redireciona para rota anterior, permite alterar url da rota anterior e continua
//funcionando
Route::get('/linkprodutos', function (){

    $url = route('meusprodutos');
    // \ para escapar aspas
    echo "<a href=\"". $url ."\">Meus Produtos</a>";
});

Route::get('/redirecionarprodutos', function (){

    return redirect()->route('meusprodutos');
});