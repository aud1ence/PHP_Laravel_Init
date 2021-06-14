<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/greeting/{name?}', function ($name = null) {
    if ($name) {
        echo 'Hello ' . $name . '!';
    } else {
        echo "Hello world!";
    }
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function (\Illuminate\Http\Request $request) {
    if ($request->username == 'admin'
        && $request->password == 'admin') {
        return view('welcome_admin');
    }
    return view('login_error');
});

Route::get('/calculate', function () {
    return view('calculate');
});

Route::post('/calculate', function (\Illuminate\Http\Request $request) {
    if (empty($request->description) || empty($request->price) || empty($request->discount)) {
        return view('display-error');
    }
    $productDescription = $request->description;
    $price = $request->price;
    $discountPercent = $request->discount;
    $discountAmount = $request->price * $request->discount * 0.1;
    $discountPrice = $request->price - $discountAmount;
    return view('display_discount', compact(['discountAmount', 'discountPrice', 'productDescription', 'price', 'discountPercent']));
});

Route::get('/dictionary', function () {
    return view('dictionary');
});

Route::post('/dictionary', function (\Illuminate\Http\Request $request) {
    if (empty($request->input)) {
        return view('dictionary-error');
    }
    $wordCheck = $request->input;
    $dictionaries = [
        'go' => 'Chạy',
        'dog' => 'Con chó',
        'cat' => 'Con mèo',
    ];
    foreach ($dictionaries as $key => $value) {
        if ($wordCheck == $key) {
            $result = $value;
            return view('dictionary-display', compact(['result','wordCheck']));
        }
    }
    return view('dictionary-error');
});
