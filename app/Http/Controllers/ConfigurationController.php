<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    // List all configurations
    public function index()
    {
        $configurations = Configuration::latest()->paginate(10);
        return view('configurations.index', compact('configurations'));
    }

    // Show create form
    public function create()
    {
        return view('configuration');
    }

    // Store new configuration
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:configurations,key',
            'value' => 'nullable|string',
        ]);

        Configuration::create($request->all());

        return redirect()->route('configuration.list')->with('success', 'Configuration added successfully!');
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
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:configurations,key,' . $configuration->id,
            'value' => 'nullable|string',
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
