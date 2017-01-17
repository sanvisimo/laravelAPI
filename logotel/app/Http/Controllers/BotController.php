<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return array(
            1 => "John",
            2 => "Mary",
            3 => "Steven"
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (object) $request->json()->all();

        $parametri = explode('"',$request->message);
        $alfred = explode(" ",$parametri[0]);
        $spaces = substr_count($parametri[0]," ")+1;

        if($spaces  == count($alfred)){
            if($alfred[0] !==  "@alfred"){
                return;
            }else{
                if(isset($alfred[2])){
                    $comando = $alfred[2];
                }else{
                    $comando = '';
                }
            }
        }else{
            return;
        }

        if($data->password == '12345'){
            switch($alfred[1]) {
                case 'barzelletta':
                    $report = new BarzellettaFileController();
                    return $report->check($comando, $parametri);
            }
        }else{
            return;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
