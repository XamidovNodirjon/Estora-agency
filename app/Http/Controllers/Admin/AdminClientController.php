<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ClientService;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        $clients = $this->clientService->getAllClients();
        return view('Admin.clients.index', [
            'clients' => $clients,
        ]);
    }

    public function show($id)
    {
        try {
            $client = $this->clientService->getClientDetails($id, true);
            return view('Admin.clients.show', compact('client'));
        } catch (\Exception $e) {
            return redirect()->route('clients')->with('error', $e->getMessage());
        }
    }
}