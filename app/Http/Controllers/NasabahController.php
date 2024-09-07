<?php
namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabahs = Nasabah::paginate(10);
        return view('bank_sampah_unit.nasabah.index', compact('nasabahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255|unique:nasabahs,nomor_induk',
            'username' => 'required|string|max:255|unique:nasabahs,username',
            'email' => 'required|email|max:255|unique:nasabahs,email',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('password', 'foto');
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('img/fotoNasabah', 'public');
        }

        Nasabah::create($data);

        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        if ($nasabah->foto && file_exists(public_path($nasabah->foto))) {
            unlink(public_path($nasabah->foto));
        }
        $nasabah->delete();

        return response()->json(['message' => 'Nasabah berhasil dihapus.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255|unique:nasabahs,nomor_induk,' . $id,
            'username' => 'required|string|max:255|unique:nasabahs,username,' . $id,
            'email' => 'required|email|max:255|unique:nasabahs,email,' . $id,
            'password' => 'nullable|string|min:6',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $nasabah = Nasabah::findOrFail($id);
        $data = $request->except('password', 'foto');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($nasabah->foto) {
                Storage::disk('public')->delete($nasabah->foto);
            }
            $data['foto'] = $request->file('foto')->store('img/fotoNasabah', 'public');
        }

        $nasabah->update($data);

        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil diperbarui.');
    }

    public function show($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        return response()->json($nasabah);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');
        $nasabah = Nasabah::where('nama', 'LIKE', "%{$query}%")->get();
        return response()->json($nasabah);
    }
}
