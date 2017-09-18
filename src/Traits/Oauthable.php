<?php
namespace Santanu\Lumen_Oauth\Traits;

use Illuminate\Hashing\BcryptHasher;
use Santanu\Lumen_Oauth\Models\AccessToken;
use Santanu\Lumen_Oauth\Models\RefreshToken;

trait Oauthable
{
    protected function getArrayableRelations()
    {
        return array_merge(parent::getArrayableRelations(), [
            'access_tokens' => $this->accessTokens,
            'refresh_tokens' => $this->refreshTokens,
        ]);
    }

    public function getUserByUsername($username) {
        return $this->where(['username' => $username])->first();
    }
	
    public function getUserByEmail($email) {
        return $this->where(['email' => $email])->first();
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPasswordHasher() {
        return (new BcryptHasher());
    }

    public function findByAccessToken($access_token) {
        return self::where('accessTokens.access_token', '=', $access_token)->first();
    }

    public function findByRefreshToken($refresh_token) {
        return self::where('refreshTokens.refresh_token', '=', $refresh_token)->first();
    }

    public function accessTokens() {
        return $this->embedsMany('Santanu\Lumen_Oauth\Models\AccessToken');
    }

    public function getAccessToken($access_token) {
        return $this->accessTokens()->where('access_token', $access_token)->first();
    }

    public function setAccessToken($data) {
        $token = ($data instanceof AccessToken) ? $data : new AccessToken($data);
        $this->accessTokens()->associate($token);
        return $this;
    }

    public function deleteAccessToken($access_token) {
        $this->accessTokens()->dissociate($this->getAccessToken($access_token));
        return $this;
    }

    public function refreshTokens() {
        return $this->embedsMany('Santanu\Lumen_Oauth\Models\RefreshToken');
    }

    public function getRefreshToken($refresh_token) {
        return $this->refreshTokens()->where('refresh_token', $refresh_token)->first();
    }

    public function setRefreshToken($data) {
        $token = ($data instanceof RefreshToken) ? $data : new RefreshToken($data);
        $this->refreshTokens()->associate($token);
        return $this;
    }

    public function deleteRefreshToken($refresh_token) {
        $this->refreshTokens()->dissociate($this->getRefreshToken($refresh_token));
        return $this;
    }
}
