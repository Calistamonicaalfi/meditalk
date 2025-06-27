<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Doctor;

class ScheduleController extends Controller
{
    public function index()
    {
        $jadwal = Schedule::with('doctor')->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $dokter = Doctor::all();
        return view('admin.jadwal.create', compact('dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:calista_doctors,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Schedule::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $dokter = Doctor::all();
        return view('admin.jadwal.edit', compact('jadwal', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:calista_doctors,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = Schedule::findOrFail($id);
        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
