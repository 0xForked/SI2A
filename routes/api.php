<?php

use Illuminate\Http\Request;
use App\Models\Data\Category;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ping', function() {
    return response()->json([
        'status' => 'ok',
        'timestamp' => \Carbon\Carbon::now(),
        'host' => request()->ip(),
        'message' => 'pong'
    ]);
});


Route::group([
    'prefix'=>'v1',
    'as' => 'api.',
    'namespace' => 'Api\V1'
], function () {
    Route::get('/role/{id}/permissions', 'PermissionApiController@permissionsByRole');

    Route::get('/category/{id}/subcategories', function($id) {
        $subcategories = Category::with('subcategories')->where('id', $id)->first();
        return response()->json($subcategories->subcategories);
    });

});
