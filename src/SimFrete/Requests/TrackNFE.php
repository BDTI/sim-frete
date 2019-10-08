<?php


namespace BDTI\SimFrete\Requests;


class TrackNFE extends AbstractRequest
{
    /**
     * @param $nfeNumber
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function track($nfeNumber)
    {
        if (!is_array($nfeNumber)) {
            $nfeNumber = [$nfeNumber];
        }

        return $this->post('/TrackingService/consultar', [
            'nfNumero' => $nfeNumber
        ]);
    }
}