<?php
/**
 * Created by PhpStorm.
 * User: sanvi
 * Date: 17/01/2017
 * Time: 23:36
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Interface BarzellettaInterface
{
    public function check($chiamata,$params);

    function getList();

    function getBarzelletta();

    function updateBarzelletta($barzelletta);

    function destroyBarzelletta();

    function exploreFile();
}