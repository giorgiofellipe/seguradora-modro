<?php

namespace Faderim\Http;

/**
 * Description of Http
 *
 * @author Ricardo Schroeder
 */
class HttpPost
{

    private $url;
    private $params;
    private $response;
    private $responseCode;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams(Array $params)
    {
        $this->params = $params;
    }

    public function getResponse()
    {
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($curl, CURLOPT_TIMEOUT, 25);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false); # Não retorna header
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); # Seguir qualquer redirecionamento que houver na URL
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->params);
        $this->response = curl_exec($curl);
        $this->responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return $this->response;
    }

    public function getValidResponse()
    {
        $this->getResponse();
        if ($this->responseCode == 200) {
            return $this->response;
        }
        if ($this->responseCode == 0) {
            throw new \Exception('O servidor não está respondendo!');
        } elseif ($this->responseCode == 404) {
            throw new \Exception('Página não encontrada!');
        } else {
            throw new \Exception('Resposta inválida do servidor! (code: ' . $this->responseCode . ')');
        }
    }

    public function getResponseCode()
    {
        return $this->responseCode;
    }

}
