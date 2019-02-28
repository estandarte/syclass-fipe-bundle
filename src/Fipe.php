<?php

namespace Syclass\FipeBundle;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Fipe
{
    # http://veiculos.fipe.org.br/api/veiculos/ConsultarMarcas
    const URL = 'http://veiculos.fipe.org.br';
    const SERVICE_INDEX = '/';
    const SERVICE_TABLE = '/api/veiculos/ConsultarTabelaDeReferencia';
    const SERVICE_MANUFACTURER = '/api/veiculos/ConsultarMarcas';
    const SERVICE_VEHICLE = '/api/veiculos/ConsultarModelos';
    const SERVICE_YEAR = '/api/veiculos/ConsultarAnoModelo';
    const SERVICE_PRICE = '/api/veiculos/ConsultarValorComTodosParametros';
    public static function getClient()
    {
        return new Client([
            'base_uri' => self::URL,
            'headers' => [
                'Host' => 'veiculos.fipe.org.br',
                'Origin' => 'http://veiculos.fipe.org.br',
                'Referer' => 'http://veiculos.fipe.org.br/',
            ],
            'http_errors' => false,
        ]);
    }
    protected static function request($url, $params){
        try {
            $client = self::getClient();
            $response = $client->request('POST', $url, $params);
            return json_decode($response->getBody());
        } catch (Exception $e) {
            return null;
        }
    }
    public static function getFipeTables($type = 1)
    {
      $client = self::getClient();
      return self::request(self::SERVICE_TABLE, []);
    }
    public static function getFipeManufacturer($table, $type = 1)
    {
        $client = self::getClient();
         return self::request(self::SERVICE_MANUFACTURER, [
            'form_params' => [
                'codigoTipoVeiculo' => $type,
                'codigoTabelaReferencia' => $table->getId(),
            ],
        ]);
    }
    public static function getFipeVehicle($manufacturer, $table, $type = 1)
    {
        $client = self::getClient();
         return self::request(self::SERVICE_VEHICLE, [
            'form_params' => [
                'codigoTipoVeiculo' => $type,
                'codigoTabelaReferencia' => $table->getId(),
                'codigoMarca' => $manufacturer->getId()
            ],
        ])->Modelos;

        // $object = json_decode($response->getBody());
        // return $object->Modelos;
    }
    public static function getIndex(Client $client)
    {
        return $client->request('GET', self::SERVICE_INDEX)
            ->getBody()
            ->getContents()
        ;
    }
    public static function getFipeYears($vehicle, $table, $type = 1)
    {
        $params = [
            'codigoTipoVeiculo' => $type,
            'codigoTabelaReferencia' => 185,//$table->getId(),
            'codigoMarca' => $vehicle->getManufacturer()->getId(),
            'codigoModelo' => $vehicle->getVehicleId(),
        ];
        $client = self::getClient();
        return self::request(self::SERVICE_YEAR, [
            'form_params' => $params
        ]);
    }
    public static function getFipePrice($vehicle, $year, $table = 176, $type = 1){
        $slug = explode('-', $year->getSlug());
        $params = [
            'codigoTabelaReferencia' => $table,
            'codigoMarca'            => $vehicle->getManufacturer()->getId(),
            'codigoModelo'           => $vehicle->getVehicleId(),
            'codigoTipoVeiculo'      => $type,
            'anoModelo'              => $slug[0],
            'codigoTipoCombustivel'  => $slug[1],
            'tipoVeiculo'            => 'carro',
            'tipoConsulta' => 'tradicional'
        ];
        $client = self::getClient();
         return self::request(self::SERVICE_PRICE, [
            'form_params' => $params
        ]);

    }

    public static function parseCookies(Response $response, RequestInterface $request = null)
    {
        if ($cookieHeader = $response->getHeader('Set-Cookie')) {
            $parser = ParserRegistry::getInstance()->getParser('cookie');
            foreach ($cookieHeader as $cookie) {
                if ($parsed = $request
                    ? $parser->parseCookie($cookie, $request->getHost(), $request->getPath())
                    : $parser->parseCookie($cookie)
                ) {
                    // Break up cookie v2 into multiple cookies
                    foreach ($parsed['cookies'] as $key => $value) {
                        $request->addCookie($key, $value);
                    }
                }
            }
        }

        return $request;
    }
}
