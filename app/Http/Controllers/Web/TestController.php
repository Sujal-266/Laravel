<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function testLivewire()
    {
        return view('UI.livewire_test', [
            'data' => [
                'name' => '',
                'email' => '',
                'number' => '',
            ],
        ]);
    }
}