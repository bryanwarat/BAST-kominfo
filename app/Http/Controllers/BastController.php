<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BastController extends Controller
{
    public function index()
    {
        return view('pages.bast.index');
    }

    public function data(Request $request)
    {
        $query = DB::table('basts')
            ->leftJoin('assets', 'basts.asset_id', '=', 'assets.id')
            ->leftJoin('employees', 'basts.employee_id', '=', 'employees.id')
            ->select(
                'basts.id',
                'basts.bast_number',
                'basts.bast_date',
                'assets.merk',
                'employees.name as employee_name'
            )
            ->orderBy('basts.bast_date', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $detailUrl = route('bast.detail', $row->id);
                $deleteUrl = route('bast.destroy', $row->id);

                return '
                    <a href="'.$detailUrl.'" class="btn btn-primary btn-sm">Detail</a>
                    <form action="'.$deleteUrl.'" method="POST" class="d-inline delete-form">
                        '.csrf_field().method_field("DELETE").'
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                ';
            })
            ->make(true);
    }

    public function detail($id)
    {
        $bast = DB::table('basts')
            ->leftJoin('assets', 'basts.asset_id', '=', 'assets.id')
            ->leftJoin('employees', 'basts.employee_id', '=', 'employees.id')
            ->leftJoin('bast_files', 'basts.id', '=', 'bast_files.bast_id')
            ->select(
                'basts.*',
                'assets.*',
                'assets.item_code',
                'employees.name as employee_name',
                'bast_files.document',
                'bast_files.photo'
            )
            ->where('basts.id', $id)
            ->first();

        return view('pages.bast.detail', compact('bast'));
    }

    public function destroy($id)
    {
        DB::table('basts')->where('id', $id)->delete();
        return redirect()->route('bast.index')->with('success', 'BAST berhasil dihapus.');
    }
}
