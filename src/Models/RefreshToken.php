<?php
namespace Santanu\Lumen_Oauth\Models;

/**
 * Class Token
 * @package Santanu\Lumen_Oauth\Models
 */
class RefreshToken extends Base
{
    protected $fillable = ['client_id', 'refresh_token', 'expires', 'scope'];
}
