<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use Illuminate\Http\Request;

class MasterItemsController extends Controller
{
    public function index()
    {
        return view('master_items.index.index');
    }

   public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;
        $hargamin = $request->hargamin;
        $hargamax = $request->hargamax;

        $data_search = MasterItem::query();

        if (!empty($kode)) $data_search->where('kode', $kode);
        if (!empty($nama)) $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        if (!empty($hargamin) && !empty($hargamax)) {
            $query->whereBetween('harga_beli', [$hargamin, $hargamax]);
        } elseif (!empty($hargamin)) {
            $query->where('harga_beli', '>=', $hargamin);
        } elseif (!empty($hargamax)) {
            $query->where('harga_beli', '<=', $hargamax);
        }


        // Include field foto
        $data_search = $data_search->select('kode', 'nama', 'jenis', 'harga_beli', 'laba', 'supplier', 'foto')
                                   ->orderBy('id')
                                   ->get();

        return response()->json([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    // Form view new/edit
    public function formView($method, $id = 0)
    {
        $item = $method === 'new' ? [] : MasterItem::find($id);
        return view('master_items.form.index', [
            'item' => $item,
            'method' => $method
        ]);
    }

    // Single view
    public function singleView($kode)
    {
        $data = MasterItem::where('kode', $kode)->first();
        return view('master_items.single.index', compact('data'));
    }

    // Submit form (create/update)
    public function formSubmit(Request $request, $method, $id = 0)
    {
        $data_item = $method === 'new' ? new MasterItem : MasterItem::find($id);

        if ($method === 'new') {
            $kode = MasterItem::count('id') + 1;
            $data_item->kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
        }

        $data_item->nama = $request->nama;
        $data_item->harga_beli = $request->harga_beli;
        $data_item->laba = $request->laba;
        $data_item->supplier = $request->supplier;
        $data_item->jenis = $request->jenis;

        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/master_items', $filename);
            $data_item->foto = 'master_items/' . $filename;
        }

        $data_item->save();

        return redirect('master-items');
    }

    public function delete($id)
    {
        MasterItem::find($id)->delete();
        return redirect('master-items');
    }

    public function updateRandomData()
    {
        $data = MasterItem::get();
        foreach($data as $item)
        {
            $kode = str_pad($item->id, 5, '0', STR_PAD_LEFT);
            $item->harga_beli = rand(100,1000000);
            $item->laba = rand(10,99);
            $item->kode = $kode;
            $item->supplier = $this->getRandomSupplier();
            $item->jenis = $this->getRandomJenis();
            $item->save();
        }
    }

    private function getRandomSupplier()
    {
        $array = ['Tokopaedi','Bukulapuk','TokoBagas','E Commurz','Blublu'];
        return $array[array_rand($array)];
    }

    private function getRandomJenis()
    {
        $array = ['Obat','Alkes','Matkes','Umum','ATK'];
        return $array[array_rand($array)];
    }
}
