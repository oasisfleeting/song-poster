<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login', ['as' => 'login', function()
{

}]);

Route::get('facebook/authorize', function()
{
    $state = new SessionStateStorage();
    $state->setState(uniqid());
    $oauth = new Illuminate\Socialite\OAuthTwo\FacebookProvider($state, '146220805447146', '82690e4ef5c49ce49a6eb84eebb07521');
    $oauth->setScope(['manage_pages', 'publish_stream', 'read_stream']);

    return Redirect::to($oauth->getAuthUrl(URL::route('callback')));
});

Route::get('facebook/callback', ['as' => 'callback', function()
{
    $state = new SessionStateStorage();
    $oauth = new Illuminate\Socialite\OAuthTwo\FacebookProvider($state, '146220805447146', '82690e4ef5c49ce49a6eb84eebb07521');
    var_dump($oauth->getAccessToken(Request::instance())->getValue());
}]);

Route::get('/', function()
{

});
