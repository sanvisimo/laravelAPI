<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class BarzellettaController
{

    const FILECONST = 'barzellette.csv';

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
                /*if(self::updateBarzelletta($params))
                    return 'barzelletta aggiunta';
                */
                return $params;
            case 'rimuovi':
                if(self::destroyBarzelletta())
                    return 'barzelletta rimossa';
            case 'lista':
               return self::getList();
        }
    }

    private function getList()
    {
        $lista = self::exploreFile();
        echo json_encode($lista);
    }

    private function getBarzelletta(){
        $lista = self::exploreFile();
        echo json_encode($lista[mt_rand(0,count($lista)-1)]);
    }

    private function updateBarzelletta($barzelletta){

        $contents = File::get(self::FILECONST);
        $contents .="\r\n".$barzelletta[1].','.$barzelletta[3];
        $bytes_written = File::put(self::FILECONST, $contents);
        if ($bytes_written !== false)
        {
            return true;
        }
    }

    private function destroyBarzelletta(){
        $contents = File::get(self::FILECONST);
        $riga = explode("\r\n", $contents);
        array_pop($riga);
        $contenuto = implode("\r\n",$riga);
        $bytes_written = File::put(self::FILECONST, $contenuto);
        if ($bytes_written !== false)
        {
            return true;
        }
    }

    private function exploreFile(){
        $contents = File::get(self::FILECONST);
        $righe = explode("\r\n", $contents);
        foreach($righe as $key => $riga){
            $linea = explode(',',$riga);
            $export[$key] = $linea[0];
            if(!empty($linea[1]))
                $export[$key] .=' - Autore: '.$linea[1];
        }
        return $export;
    }
}
