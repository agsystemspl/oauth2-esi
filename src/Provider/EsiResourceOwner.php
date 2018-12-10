<?php

namespace AGSystems\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class EsiResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    protected $response;

    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->getCharacterID();
    }

    public function getCharacterID()
    {
        return $this->getValueByKey($this->response, 'CharacterID');
    }

    public function getCharacterName()
    {
        return $this->getValueByKey($this->response, 'CharacterName');
    }

    public function getCharacterOwnerHash()
    {
        return $this->getValueByKey($this->response, 'CharacterOwnerHash');
    }

    public function toArray()
    {
        return $this->response;
    }
}
