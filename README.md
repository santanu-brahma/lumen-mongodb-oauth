# OAuth Library for Lumen & MongoDB

Package for creating oauthable authorization based on Lumen Framework and MongoDB.

## Package Installations

- Add "santanu/lumen-mongodb-oauth": "*" in your lumen project, then run composer update.
- Copy all migration files from database/migrations to project's db migration directory.
- Run php artisan migrate from project's root directory.
- Add 'client_id' and 'client_secret' value in the clients collection.
- Need to copy config files from src/config to project's config directory.
- Now change User model name and path in oauth.php config file.

## Configure Application

- Model User should be implement Santanu\Lumen_Oauth\Interfaces\Oauthable
- Add trait for model User Santanu\Lumen_Oauth\Traits\Oauthable
- Add service provider Santanu\Lumen_Oauth\Providers\ServiceProvider
- In routes/web.php add following lines for Oauth service,
```php
$app->group(['prefix' => 'oauth'], function() use ($app)
{
    $app->post('access', function() use($app) {
		return $app->make('oauth.routes')->accessToken();
    });
	$app->post('refresh', function() use($app) {
		return $app->make('oauth.routes')->refreshToken();
    });
});
```
- In routes add 'oauth' as a middleware in service routes.

## Authorization Service

- POST application-url/oauth/access
Params: grant_type(password), client_id, client_secret, username, password
Response: access_token, expires_in, token_type, scope, refresh_token 
- POST application-url/oauth/refresh
Params: grant_type(refresh_token), client_id, client_secret, refresh-token
Response: access_token, expires_in, token_type, scope, refresh_token 
- Send header in all API requests: Authorization: Bearer access_token

## Important Information

- This is library is based on Lumen and MongoDB if you are looking for Lumen and MySQL package then use it *From: https://github.com/santanu-brahma/lumen-mysql-oauth*