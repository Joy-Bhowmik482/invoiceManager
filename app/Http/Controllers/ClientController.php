<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Store a newly created client.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        Client::create($data);

        return redirect()->route('clientList')->with('success', 'Client added successfully.');
    }

    /**
     * Display a list of all clients.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clientList', ['clients' => $clients]);
    }

    /**
     * Display the specified client.
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('viewClient', ['client' => $client]);
    }

    /**
     * Show the form for editing a client.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('editClient', ['client' => $client]);
    }

    /**
     * Update the client in the database.
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        $client->update($data);

        return redirect()->route('clientList')->with('success', 'Client updated successfully.');
    }

    /**
     * Delete a client from the database.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clientList')->with('success', 'Client deleted successfully.');
    }

    public function create()
    {
        return view('addClient');
    }
}
