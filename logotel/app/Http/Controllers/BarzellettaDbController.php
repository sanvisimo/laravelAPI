<?php

namespace App\Http\Controllers;

use App\Barzelletta;
use App\Autore;
use Illuminate\Http\Request;
use App\Http\Controllers\BarzellettaInterface as BarzellettaInterface;

class BarzellettaDbController implements BarzellettaInterface
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  str $chiamata
     * @param  array $params
     * @return \Illuminate\Http\Response
     */
    public function check($chiamata,$params)
    {
        switch ($chiamata){
            case '':
                return self::getBarzelletta();
            case 'aggiungi':
                return self::updateBarzelletta($params);
            case 'rimuovi':
                if(self::destroyBarzelletta()) {
                    return 'barzelletta rimossa';
                }
            case 'lista':
                return self::getList();
        }
    }

    function getList()
    {
        $lista = self::fetchBarzellette();
        echo json_encode($lista);
    }

    function getBarzelletta(){
        $lista = self::fetchBarzellette();

        $random = mt_rand(0,count($lista)-1);
        /*Barzelletta::where('id', $random)
            ->update([
                'visualizzazioni' => 'visualizzazioni + 1'
            ]);*/
        echo json_encode($lista[$random]);
    }

    function updateBarzelletta($barzelletta){

        $autore = Autore::where('autore','=',$barzelletta[3])->first();

        if($autore) {
            $autore_id = $autore->id;
        }else{
            $autore = Autore::create([
                'autore' => $barzelletta[3]
            ]);
            $autore_id = $autore->id;
        }

        Barzelletta::create([
            'barzelletta' => $barzelletta[1],
            'autores_id' => $autore_id
        ]);

        return 'barzelletta aggiunta';
    }

    function destroyBarzelletta(){
        if(Barzelletta::orderBy('created_at', 'desc')->first()->delete()){
            return true;
        }
    }

    function fetchBarzellette(){
        $result = array();
        $barzellette = Barzelletta::with('autores')->get();
        foreach ($barzellette as $barzelletta){
            array_push($result,$barzelletta->barzelletta.' - Autore: '.$barzelletta->autores['autore']);
        }
        return $result;
    }
}
