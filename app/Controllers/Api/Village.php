<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\VillageModel;
use CodeIgniter\API\ResponseTrait;

class Village extends BaseController
{
    use ResponseTrait;
    protected $villageModel;
    public function __construct()
    {
        $this->villageModel = new VillageModel();
    }
    
    public function getData()
    {
        $request = $this->request->getPost();
        $village = $request['village'];
        if ($village == '1') {
            $vilProperty = $this->villageModel->get_sumpur_api()->getRowArray();
            $geoJson = json_decode($this->villageModel->get_geoJson_api($village)->getRowArray()['geoJson']);
            $content = [
                'type' => 'Feature',
                'geometry' => $geoJson,
                'properties' => [
                    'id' => $vilProperty['id_regional'],
                    'name' => $vilProperty['name'],
                ]
            ];
            $response = [
                'data' => $content,
                'status' => 200,
                'message' => [
                    "Success display data of Nagari "
                ]
            ];
            return $this->respond($response);
        } elseif ($village == '2') {
            $vilProperty = $this->villageModel->get_desa_wisata_api()->getRowArray();
            $geoJson = json_decode($this->villageModel->get_geoJson_api($village)->getRowArray()['geoJson']);
            $content = [
                'type' => 'Feature',
                'geometry' => $geoJson,
                'properties' => [
                    'id' => $vilProperty['id_regional'],
                    'name' => $vilProperty['name'],
                ]
            ];
            $response = [
                'data' => $content,
                'status' => 200,
                'message' => [
                    "Success display data of Desa Wisata "
                ]
            ];
            return $this->respond($response);
        }
    }
}
