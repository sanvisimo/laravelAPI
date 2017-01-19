<?php

use Illuminate\Database\Seeder;
use App\Barzelletta;
use App\Autore;

class BarzelletteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = File::get(public_path().'/barzellette.csv');
        $righe = explode("\r\n", $contents);
        foreach($righe as $key => $riga){
            $linea = explode(';',$riga);
            if(!empty($linea[1])) {
                $autore = Autore::where('autore', '=', $linea[1])
                    ->first();
                $autor = $autore->id;
            }else{
                $autor=0;
            }
            Barzelletta::create([
                'barzelletta' => $linea[0],
                'autore_id' => $autor
            ]);

        }
    }
}
