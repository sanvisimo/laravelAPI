<?php

use Illuminate\Database\Seeder;
use App\Autore;

class AutoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $autori = array();
        $contents = File::get(public_path().'/barzellette.csv');
        $righe = explode("\r\n", $contents);
        foreach($righe as $key => $riga){
            $linea = explode(';',$riga);

            if(!empty($linea[1])) {
                array_push($autori,$linea[1]);
            }
        }

        $autori = array_unique($autori);

        foreach($autori as $autore){
            Autore::create([
                'autore' => $autore
            ]);
        }
    }
}
