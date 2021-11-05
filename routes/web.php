<?php
/*
 __     __  __    __  ________        __         ______   _______    ______   __     __  ________  __              _______   __        ______    ______
|  \   |  \|  \  |  \|        \      |  \       /      \ |       \  /      \ |  \   |  \|        \|  \            |       \ |  \      /      \  /      \
| $$   | $$| $$  | $$| $$$$$$$$      | $$      |  $$$$$$\| $$$$$$$\|  $$$$$$\| $$   | $$| $$$$$$$$| $$            | $$$$$$$\| $$     |  $$$$$$\|  $$$$$$\
| $$   | $$| $$  | $$| $$__          | $$      | $$__| $$| $$__| $$| $$__| $$| $$   | $$| $$__    | $$            | $$__/ $$| $$     | $$  | $$| $$ __\$$
 \$$\ /  $$| $$  | $$| $$  \         | $$      | $$    $$| $$    $$| $$    $$ \$$\ /  $$| $$  \   | $$            | $$    $$| $$     | $$  | $$| $$|    \
  \$$\  $$ | $$  | $$| $$$$$         | $$      | $$$$$$$$| $$$$$$$\| $$$$$$$$  \$$\  $$ | $$$$$   | $$            | $$$$$$$\| $$     | $$  | $$| $$ \$$$$
   \$$ $$  | $$__/ $$| $$_____       | $$_____ | $$  | $$| $$  | $$| $$  | $$   \$$ $$  | $$_____ | $$_____       | $$__/ $$| $$_____| $$__/ $$| $$__| $$
    \$$$    \$$    $$| $$     \      | $$     \| $$  | $$| $$  | $$| $$  | $$    \$$$   | $$     \| $$     \      | $$    $$| $$     \\$$    $$ \$$    $$
     \$      \$$$$$$  \$$$$$$$$       \$$$$$$$$ \$$   \$$ \$$   \$$ \$$   \$$     \$     \$$$$$$$$ \$$$$$$$$       \$$$$$$$  \$$$$$$$$ \$$$$$$   \$$$$$$

*/
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'panel','namespace' => 'Backend','as' => 'panel.'], function (){
    Route::group(['prefix' => 'auth','as' => 'auth.'], function (){
        Route::get('/login','AuthController@loginIndex')->name('login.index');
        Route::post('/login-process','AuthController@loginProcess')->name('login.process');
    });

    Route::group(['middleware' => 'AdminMiddleware'], function (){
        Route::get('/','HomeController@index')->name('home.index');
        Route::get('/auth/logout','AuthController@logout')->name('auth.logout');

        Route::group(['prefix' => '/category-manage', 'as' => 'category-manage.'], function (){
            Route::get('/list','CategoryController@list')->name('list.index');
            Route::post('/process/{id?}','CategoryController@process')->name('list.process');
            Route::get('/destroy/{id}','CategoryController@destroy')->name('list.destroy');
        });

        Route::group(['prefix' => '/blog-manage', 'as' => 'blog-manage.'], function (){
            Route::get('/list','BlogController@list')->name('list.index');
            Route::get('/form/{id?}','BlogController@form')->name('form.index');
            Route::post('/editor-photos-upload','BlogController@editorUpload')->name('form.editorUpload');
        });

    });


});
