<?php

namespace AGSystems\OAuth2\Client\Provider;

use League\OAuth2\Client\OptionProvider\HttpBasicAuthOptionProvider;
use League\OAuth2\Client\OptionProvider\OptionProviderInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Esi extends AbstractProvider
{
    use BearerAuthorizationTrait;

    public function getBaseAuthorizationUrl()
    {
        return 'https://login.eveonline.com/oauth/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://login.eveonline.com/oauth/token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://login.eveonline.com/oauth/verify';
    }

    protected function getDefaultScopes()
    {
        return [];
    }

    protected function getScopeSeparator()
    {
        return ' ';
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (!empty($data['error'])) {
            throw new IdentityProviderException($data['error_description'], $response->getStatusCode(), $data);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new EsiResourceOwner($token);
    }
}
