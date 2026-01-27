<?php

namespace App\Http\Controllers;

use App\Models\configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    // List all configurations
    public function index()
    {

        $configurations = configuration::latest()->paginate(1);
        return view('configuration', compact('configurations'));
    }

    // Store new configuration
    public function store(Request $request)
    {
        if($request->id)
        {
            $configuration = configuration::find($request->id);
            $configuration->update($request->only(['name', 'email', 'phone', 'address', 'deposit_address', 'deposit_method']));
            return redirect()->route('configuration.create')->with('success', 'Configuration updated successfully!');
        }
        else
        {
            configuration::create($request->only(['name', 'email', 'phone', 'address','deposit_address', 'deposit_method']));
            return redirect()->route('configuration.create')->with('success', 'Configuration added successfully!');
        }
    }

    // Show single configuration
    public function show(Configuration $configuration)
    {
        return view('configurations.show', compact('configuration'));
    }

    // Show edit form
    public function edit(Configuration $configuration)
    {
        return view('configurations.edit', compact('configuration'));
    }

    // Update configuration
    public function update(Request $request, Configuration $configuration)
    {
      $request->validate([
    'name'    => 'required|string|max:255',
    'email'   => 'required|email|max:255',
    'phone'   => 'required|string|max:20',
    'address' => 'required|string|max:500',
]);

        $configuration->update($request->all());

        return redirect()->route('configuration.list')->with('success', 'Configuration updated successfully!');
    }

    // Delete configuration
    public function destroy(Configuration $configuration)
    {
        $configuration->delete();
        return redirect()->route('configuration.list')->with('success', 'Configuration deleted successfully!');
    }
}
