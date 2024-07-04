<?php

namespace App\Http\Controllers\Jastip;

use App\Http\Controllers\Controller;
use App\Models\Jastip;
use Illuminate\Http\Request;

class JastipController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = $request->input('per_page', 10); // Default per page is 10 if not specified

        $query = Jastip::orderBy('created_at', 'desc');

        // Apply status filters if any
        if ($request->has('status')) {
            $statuses = $request->input('status');
            $query->whereIn('status', $statuses);
        }

        $dataJastip = $query->paginate($perPage);

        return view('admin.jastip.jastip', compact('user', 'dataJastip'));
    }


    public function addPesanan(Request $request)
    {
        $user = auth()->user();

        Jastip::create([
            'user_id' => $user->id,
            'nama_cus' => $request->input('nama_cus'),
            'no_wa' => $request->input('no_wa'),
            'kategori' => $request->input('kategori'),
            'pengantaran' => $request->input('pengantaran'),
            'alamat' => $request->input('alamat'),
            'deskripsi' => $request->input('deskripsi'),
            'total_harga' => $request->input('total_harga'),
        ]);
        return redirect()->back()->with('success', 'Berhasil Menambah Pesanan');
    }
    public function visible(Request $request, $id)
    {
        $jastip = Jastip::findOrFail($id);

        // Set nilai visible sesuai dengan checkbox
        $jastip->status = $request->input('status') ? true : false;

        // Simpan perubahan
        $jastip->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Status visibility produk telah diubah.');
    }
    public function filterStatus(Request $request)
    {
        $user = auth()->user();
        $filter = $request->input('filter');
        $dataAktif = Jastip::where('status', 1)->get();
        return redirect()->back()->with('success', 'Berhasil Filter data status');
    }
    public function editPesanan($id, Request $request)
    {
        $user = auth()->user();
        $data = [
            'user_id' => $user->id,
            'nama_cus' => $request->input('nama_cus'),
            'no_wa' => $request->input('no_wa'),
            'kategori' => $request->input('kategori'),
            'pengantaran' => $request->input('pengantaran'),
            'alamat' => $request->input('alamat'),
            'deskripsi' => $request->input('deskripsi'),
            'total_harga' => $request->input('total_harga'),
        ];

        Jastip::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil Edit Data Pesanan');
    }
    public function deletePesanan($id)
    {
        Jastip::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus data pesanan jastip');
    }
}
