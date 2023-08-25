<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller('AuthController')
    ->group(function($g) {
        $g->post('/login','login');
    });
    
Route::middleware('jwt')->group(function($jwt) {
    $jwt->controller('AuthController')->group(function($g) {
        $g->post('/logout', 'logout');
        $g->get('/get_profile', 'get_profile');
        $g->get('/refresh', 'refresh');
    });

    $jwt->middleware('role.admin')
        ->prefix('admin')
        ->group(function($admin) {

            $admin->prefix('product')
                ->controller('ProductController')
                ->group(function($g) {
                    $g->get('/get_list', 'get_list');
                    $g->post('/add', 'store');
                    $g->put('/edit/{id}', 'update');
                    $g->get('/detail/{id}', 'detail');
                    $g->delete('/delete/{id}', 'delete');
            });
        
            $admin->prefix('user')
                ->controller('UserController')
                ->group(function($g) {
                    $g->get('/get_list', 'get_list');
                    $g->post('/add', 'store');
                    $g->put('/edit/{id}', 'update');
                    $g->get('/detail/{id}', 'detail');
                    $g->delete('/delete/{id}', 'delete');
            });
    });

    $jwt->middleware('role.user')
        ->prefix('users')
        ->group(function($users) {
            $users->prefix('product')
                ->controller('ProductController')
                ->group(function($g) {
                    $g->get('/get_list', 'get_list');
                    $g->post('/add', 'store');
                    $g->put('/edit/{id}', 'update');
                    $g->get('/detail/{id}', 'detail');
                    $g->delete('/delete/{id}', 'delete');
            });
    });
});
