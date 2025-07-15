<?php

namespace App\Http\Controllers; // Ubah namespace ini

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $dokter = Doctor::with('schedules')->get();
        return view('admin.dokter.index', compact('dokter'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'spesialis' => 'required',
            'kontak' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dokter', 'public');
        }
        Doctor::create($data);
        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokter = Doctor::findOrFail($id);
        return view('admin.dokter.edit', compact('dokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'spesialis' => 'required',
            'kontak' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dokter = Doctor::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dokter', 'public');
        }
        $dokter->update($data);
        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function show($id)
    {
        $dokter = Doctor::with('schedules')->findOrFail($id);
        return view('admin.dokter.show', compact('dokter'));
    }

    public function destroy($id)
    {
        $dokter = Doctor::findOrFail($id);
        $dokter->delete();
        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}