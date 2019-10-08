<?php


namespace BDTI\SimFrete\Requests;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

abstract class AbstractRequest
{
    /** @var string */
    protected $wsEmp;

    /** @var string */
    protected $wsUser;

    /** @var string */
    protected $wsPass;

    /** @var ClientInterface */
    protected $httpClient;

    /**
     * AbstractRequest constructor.
     * @param $wsEmp
     * @param $wsUser
     * @param $wsPass
     */
    public function __construct($wsEmp, $wsUser, $wsPass)
    {
        $this->wsEmp    = $wsEmp;
        $this->wsUser   = $wsUser;
        $this->wsPass   = $wsPass;
    }

    /**
     * @param ClientInterface $client
     * @return AbstractRequest
     */
    public function setHttpClient(ClientInterface $client)
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        if ($this->httpClient) {
            return $this->httpClient;
        }

        return new Client([
            'base_uri' => $this->getBaseUrl()
        ]);
    }

    public function getBaseUrl()
    {
        return sprintf("https://%s.simfrete.com", $this->wsEmp);
    }

    /**
     * @param $uri
     * @param $postData
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($uri, $postData)
    {
        $client  = $this->getClient();

        $request = $client->request('POST', $uri, [
            "json" => $this->withAuthentication($postData)
        ]);

        return json_decode($request->getBody());
    }

    /**
     * @param array $postData
     * @return array
     */
    private function withAuthentication($postData = [])
    {
        $authData = [
            "wsEmp" => $this->wsEmp,
            "wsUsr" => $this->wsUser,
            "wsPwd" => $this->wsPass
        ];

        return $postData + $authData;
    }
}