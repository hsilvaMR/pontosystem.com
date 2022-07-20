<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Utilizador\Home;
use App\Http\Controllers\Utilizador\UserArea;
use App\Http\Controllers\Utilizador\Ponto;
use App\Http\Controllers\Login;
use App\Http\Controllers\Backoffice\Dashboard;
use App\Http\Controllers\Backoffice\Admin;
use App\Http\Controllers\Backoffice\Utilizador;
// use App\Http\Controllers\Backoffice\Ponto;

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

// Route::get('/', function () {
//     return view('welcome');
// });

/*******Commandos Artisan PHP********/
Route::group(   ['prefix' => 'artisan'],function () {

    //  create link diretorio
    // Route::get('/linkF', function(){
    //     // $output = new \Symfony\Component\Console\Output\BufferedOutput;

    //     // $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/pontosystemFile/storage';
    //     // $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/pontosystemFile/storage/app/public';
    //     // symlink($targetFolder, $linkFolder);
    //     // echo 'Symlink process successfully completed';
    //     // rm public/storage
    //     Artisan::call('storage:link');
    //     echo "Pasta Publica Criado com Sucesso";
    // });

    Route::get('/middlewareUser', function () {
        Artisan::call('make:middleware UserArea');
        echo "classe  middleware  Criado com Sucesso";
    });

    Route::get('/emailFile', function () {
        Artisan::call('make:mail MailRecover');
        echo "classe  email  Criado com Sucesso";
    });

    Route::get('/controlerFile', function () {
        Artisan::call('make:controller Utilizador/UserArea1');
        echo "Controller Criado com Sucesso";
    });

    Route::get('/linkstorage', function () {
        $targetFolder = base_path() . '/storage/app/public';
        $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/public';
        symlink($targetFolder, $linkFolder);
        echo "Pasta Publica Criado com Sucesso";
    });

});
 


/*******utiilizadores********/
Route::get('/', [Home::class, 'index'])->name('homePage');


//Abrir Ponto
Route::get('/ponto/abrir', [Ponto::class, 'abrirPage']);
Route::post('/ponto/open', [Ponto::class, 'abrir'])->name('checkOpen');
// fechar ponto 
Route::get('/ponto/fechar', [Ponto::class, 'fecharPage']);
Route::post('/ponto/close', [Ponto::class, 'fechar'])->name('checkClose');

/*******validar pin********/
Route::post('/ponto/validar/pin', [App\Http\Controllers\Utilizador\Ponto::class, 'validarPin'])->name('chekPin');

Route::get('/admin', [Login::class, 'pageLoginAdmin'])->name('pageLogin2');
Route::post('/admin/check', [Login::class, 'loginAdmin'])->name('login2');

/*
|--------------------------------------------------------------------------
| Backoffice
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => ('backoffice')],  function () {

    Route::get('/backoffice', [Dashboard::class, 'index'])->name('pageDashboard');
    // area de utilizador
    Route::get('/users', [Utilizador::class, 'index'])->name('pageGestUser');
    // ADD USER 
    Route::get('/user/add', [Utilizador::class, 'add'])->name('pageAddUser');
    Route::post('/user/add/form', [Utilizador::class, 'addPost'])->name('adduser');
    // EDIT
    Route::get('/user/edit/{id}', [Utilizador::class, 'edit'])->name('pageEddUser');
    Route::post('/user/edit/form', [Utilizador::class, 'editPost'])->name('editUser');
    // Delete user 
    Route::post('/user/delet/{id}', [Utilizador::class, 'delet']);

    //Minha conta admin
    Route::get('/minha-conta', [Admin::class, 'show'])->name('pageShowAdmin');
    // editar conta  admin
    Route::get('minha-conta/edit/{id}', [Admin::class, 'edit'])->name('pageEditAdmin');
    Route::post('minha-conta/edit', [Admin::class, 'editPost'])->name('editADMI');

    // Registo de Horas
    Route::get('/registo-hora', [App\Http\Controllers\Backoffice\Ponto::class, 'index'])->name('pagePontos');
    // Consulta de Hora
    Route::post('/consulta-hora', [App\Http\Controllers\Backoffice\Ponto::class, 'consulta'])->name('pageConsulta');

});
/*
|--------------------------------------------------------------------------
| Validação Pin | Ponto Área Public 
|--------------------------------------------------------------------------
*/

// Route::group(['prefix' => 'ponto', 'middleware' => ('ponto')],  function () {

//     Route::get('/abrir', [App\Http\Controllers\Utilizador\Ponto::class, 'index'])->name('pageOpen');
//     Route::get('/fechar', [App\Http\Controllers\Utilizador\Ponto::class, 'index'])->name('PageClose');
// });


/*
|--------------------------------------------------------------------------
| EMAIL
|--------------------------------------------------------------------------
*/
Route::get('/ativar/{token}', [Login::class, 'ativeCount'])->name('pageAtivar');
Route::post('/validar-conta', [Login::class, 'ativeCountPost'])->name('pageVAC');

// reset password
Route::post('/reset-validar-form', [Login::class, 'senMailFormRecover'])->name('pageRVFR');
Route::get('/recuperar-password/{token}', [Login::class, 'recuperarPage'])->name('pageRecu');
Route::post('/reset-validar', [Login::class, 'recuperarPassword'])->name('pageRV');

/*
|--------------------------------------------------------------------------
| Area de Colaborador
|--------------------------------------------------------------------------
*/
Route::get('/login', [Login::class, 'pageLoginUser'])->name('pageLogin');
Route::post('/login/validate', [Login::class, 'loginUser'])->name('loginVLUser');

Route::group(['prefix' => 'area-cliente', 'middleware' => ('userArea')],  function () {

    Route::get('/dashboard', [UserArea::class, 'index'])->name('pageDashUser');
    Route::post('/consulta-hora', [UserArea::class, 'consulta'])->name('pageCsCL');
    Route::get('/minha-conta', [UserArea::class, 'myProfile'])->name('pageCL');
    Route::get('/minha-conta/editar/{id}', [UserArea::class, 'editProfile'])->name('pageCLedit');
    Route::post('minha-conta/edit', [UserArea::class, 'editPost'])->name('editCL');
});
