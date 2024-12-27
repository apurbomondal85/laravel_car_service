<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('public.pages.about.clients', [
            'clients' => Client::getClient(),
        ]);
    }

    public function show(Request $request)
    {
        $sponsor = Client::find((int)$request->id);
        abort_unless($sponsor, 404);

        return $sponsor;
    }
}
