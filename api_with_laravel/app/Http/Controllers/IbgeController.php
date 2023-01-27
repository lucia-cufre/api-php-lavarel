<?php

namespace App\Http\Controllers;

use App\Models\Ibge;
use Illuminate\Support\Facades\Http;

class IbgeController extends Controller
{
    public function index()
    {
        $response = Http::get('http://servicodados.ibge.gov.br/api/v1/localidades/estados/33/municipios');
        $dados = json_decode($response->getBody()->getContents());

       /*  $result = array_map(function ($info, $index) {
            return [
                    $info[$index]->id,
                    $info[$index]->name
            ];
        }, $dados); */
      /*   $valores[] = array_map(function($obj,$i) {
            return array($obj[0]->id, $obj[0]->name);
        }, $dados); */
        /*  $result = $dados->map(function ($info, $key) {
        return [
        'id' => $info->id,
        'name' => $info->name
        ];
        }); */

        /* Ibge::create([
        'ibge_id' => $dados->id,
        'ibge_name' => $dados->name,
        
        ]);  */
        return $dados;
    }


}