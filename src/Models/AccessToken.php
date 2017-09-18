<?php
namespace Santanu\Lumen_Oauth\Models;

/**
 * Class Token
 * @package Santanu\Lumen_Oauth\Models
 */
class AccessToken extends Base
{
    protected $fillable = ['client_id', 'access_token', 'expires', 'scope'];
}
