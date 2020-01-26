<?php
namespace App;


use GuzzleHttp\Client;
use PHPUnit\Framework\Constraint\IsFalse;

class MinistraClient
{
    public $client;
    const API_URL = 'http://ministra.avirtel.az/stalker_portal/api/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::API_URL,
            'timeout' => '5.0'
        ]);
    }

    public function getData($uri)
    {
        $data = $this->client->get($uri)->getBody();
        return json_decode($data);
    }

    public function postData($uri, $payload)
    {
        $data = $this->client->post($uri, [
            'form_params' => $payload
        ])->getBody();
        return json_decode($data);
    }


    public function createUser($payload)
    {
        return True;
    }

    public function getTariff(array $package_ids)
    {

        $tariffs = $this->getData('tariffs')->results;
        foreach($tariffs as $tariff) {
            $ids = [];
            foreach ($tariff->packages as $pac) {
                $ids[] = $pac->id;
            }
            if($ids and array_diff($package_ids, $ids) == []) {
                $tariff_id = $tariff->id;
                return $tariff_id;
            }
        }
    }

}


