<?php


namespace BDTI\SimFrete\Requests;


class ConsultFreight extends AbstractRequest
{
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
    public function consult($senderDocument,
                            $recipientDocument,
                            $senderLocation,
                            $recipientLocation,
                            $value = 0,
                            $weight = 0,
                            $volume = 0,
                            $conditionals = [])
    {
        return $this->post('/CotacaoService/consultar', [
            "remetenteCnpj"     => $senderDocument,
            "destinatarioCnpj"  => $recipientDocument,
            "origem"            => $senderLocation,
            "destino"           => $recipientLocation,
            "tipoOperacao"      => 4,
            "volumeTotal"       => $volume,
            "valorTotal"        => $value,
            "pesoTotal"         => $weight,
            "condicionais"      => $conditionals ?: []
        ]);
    }
}