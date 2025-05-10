<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phones = Phone::latest()->get();
        return view('admin.whatsapp.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.whatsapp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'whatsapp' => ['required', 'regex:/^(0|62)8[1-9][0-9]{6,11}$/'],
        ]);

        Phone::create([
            'whatsapp' => $request->whatsapp,
        ]);

        return redirect()->route('admin.whatsapp.index')->with('message', 'Nomor WhatsApp has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return redirect()->route('admin.whatsapp.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $phone = Phone::findOrFail($id);
        return view('admin.whatsapp.edit', compact('phone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'whatsapp' => ['required', 'regex:/^(0|62)8[1-9][0-9]{6,11}$/'],
        ]);

        $phone = Phone::findOrFail($id);

        $phone->update([
            'whatsapp' => $request->whatsapp,
        ]);

        return redirect()->route('admin.whatsapp.index')->with('message', 'Nomor WhatsApp has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $phone = Phone::findOrFail($id);

        $phone->delete();

        return redirect()->route('admin.whatsapp.index')->with('message', 'Nomor WhatsApp has been deleted');
    }
}
