<?php

use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});

//post:used for forms send data for server
//get:for read data only

Route::view('/users','users',['name' =>'Aya Hamdan']); 

Route::get('/users/{id}', function($id){
    return 'User '. $id;
});

Route::get('/post/{post}/comments/{comment}',function(string $postId, string $commentId ){
    return 'post id '.$postId. 'comment id '.$commentId;
});

//http://127.0.0.1:8000/user/aya
//return aya
//http://127.0.0.1:8000/user/
//return john
Route::get('/user/{name?}', function (string $name = 'John'){// لما احط علامة الاستفهام يعني بقدر ما احط المتغير بقدر اترك مكانه فاضي فبوخذ القيمة الافتراضية
    return $name;
});


/***********************************
 * *********************************
 * *********************************
 * *********************************
*/
//1- define a new route so the user can access it through browser
//2- define controller that renders a view
//3- define view that contains list of posts
//4- remove any static html data from the view

Route::get('/posts', [PostController::class, 'index']) -> name('posts.index');

Route::get('/posts/create', [PostController::class, 'create']) -> name('posts.create');//create is the name of action 

Route::get('/posts/{post}/edit',[PostController::class, 'edit']) ->name('posts.edit');

Route::post('/posts', [PostController::class, 'store']) ->name('posts.store');

Route::get('/posts/{post}',[PostController::class, 'show']) ->name('posts.show');

Route::put('/posts/{posts}',[PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/{posts}',[PostController::class, 'destroy'])->name('posts.destroy');






