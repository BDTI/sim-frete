<?php


namespace BDTI\SimFrete;


use BDTI\SimFrete\Requests\AbstractRequest;
use BDTI\SimFrete\Requests\ConsultFreight;
use BDTI\SimFrete\Requests\TrackNFE;

class Api
{
    private $wsEmp;
    private $wsUsr;
    private $wsPwd;

    /**
     * Api constructor.
     * @param $wsEmp
     * @param $wsUsr
     * @param $wsPwd
     */
    public function __construct($wsEmp, $wsUsr, $wsPwd)
    {
        $this->wsEmp = $wsEmp;
        $this->wsUsr = $wsUsr;
        $this->wsPwd = $wsPwd;
    }

    /**
     * @param string $nfeNumber
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function track($nfeNumber)
    {
        /** @var TrackNFE $request */
        $request = $this->getRequest(TrackNFE::class);
        return $request->track($nfeNumber);
    }

    /**
     * @param $senderDocument
     * @param $recipientDocument
     * @param $senderLocation
     * @param $recipientLocation
     * @param int $value
     * @param int $weight
     * @param int $volume
     * @param array $conditionals
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function consult($senderDocument, $recipientDocument, $senderLocation, $recipientLocation, $value = 0, $weight = 0, $volume = 0, $conditionals = [])
    {
        /** @var ConsultFreight $request */
        $request = $this->getRequest(ConsultFreight::class);
        return $request->consult($senderDocument, $recipientDocument, $senderLocation, $recipientLocation, $value, $weight, $volume, $conditionals);
    }

    /**
     * @param $requestClass
     * @return AbstractRequest
     */
    private function getRequest($requestClass)
    {
        return new $requestClass($this->wsEmp, $this->wsUsr, $this->wsPwd);
    }
}