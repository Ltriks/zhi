 <?php

use Illuminate\Http\Request;

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

 Route::get('/topics','TopicsController@index')->middleware('api');
 Route::get('/user/followers/{id}','FollowersController@index');
 Route::get('/answer/{id}/comments','CommentsController@answer');
 Route::get('/question/{id}/comments','CommentsController@question');

 Route::post('/question/follower','QuestionFollowController@follower')->middleware('auth:api');
 Route::post('/question/follow','QuestionFollowController@followThisQuestion')->middleware('auth:api');
 Route::post('/user/follow','FollowersController@follow')->middleware('auth:api');
 Route::post('/answer/{id}/votes/users','VotesController@users');
 Route::post('/answer/votes','VotesController@vote');
 Route::post('/message/store','MessageController@store');
 Route::post('comment','CommentsController@store');


