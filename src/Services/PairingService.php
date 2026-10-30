<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class PairingService extends AbstractService
{
    /**
     * 
     * @return array{mimetype:string,data:string}
     */
    function qr(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/auth/qr");
    }

    function requestCode(string $phoneNumber, ?string $method = null, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();
        
        return $this->client->post("/api/{$session}/auth/request-code", compact('phoneNumber', 'method'));
    }

    function challenge(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/auth/passkey/challenge");
    }

    /**
     * @param array{clientDataJSON:string,authenticatorData:string,signature:string,userHandle:string} $response
     */
    function passkey(
        ?string $id,
        string $rawId,
        string $type,
        array $response,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/auth/passkey", compact('id', 'rawId', 'type', 'response'));
    }

    function confirmation(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/auth/passkey/confirmation");
    }

    function confirm(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/auth/passkey/confirm");
    }

    /**
     * 
     * @return array{mimetype:string,data:string}
     */
    function screenshot(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/screenshot", get_defined_vars());
    }
}