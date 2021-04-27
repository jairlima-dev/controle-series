<?php


namespace App\Http\Controllers;


class PagesController
{
    public function __invoke()
    {
        return view('welcome');
    }

}
