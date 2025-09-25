<?php

namespace App\Http\Controllers;

use App\Models\Bast;
use App\Models\Asset;
use App\Models\BastFile;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AssetController extends Controller
{
    public function index()
    {
        return view('pages.asset.index');
    }

    public function getData(Request $request)
{
    if ($request->ajax()) {
        $query = Asset::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('price', function ($row) {
                return 'Rp ' . number_format($row->price, 0, ',', '.');
            })
            ->editColumn('condition', function ($row) {
                if ($row->condition === 'B') {
                    return '<span class="badge bg-success">Baik</span>';
                } elseif ($row->condition === 'RR') {
                    return '<span class="badge bg-danger text-dark">Rusak Ringan</span>';
                } elseif ($row->condition === 'RB') {
                    return '<span class="badge bg-warning text-dark">Rusak Berat</span>';
                }
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="'.route('asset.detail', $row->id).'" class="btn btn-info btn-sm">
                        <i class="mdi mdi-eye"></i> Detail
                    </a>
                    <a href="'.route('asset.edit', $row->id).'" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    <form action="'.route('asset.destroy', $row->id).'" method="POST" class="d-inline delete-form">
                        '.csrf_field().method_field('DELETE').'
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['condition', 'action'])
            ->make(true);
    }
}


    public function create()
    {
        return view('pages.asset.create');
    }

    public function bastDetail($assetId, $bastId)
    {
        $asset = DB::table('assets')->where('id', $assetId)->first();

        $bast = DB::table('basts')
            ->leftJoin('assets', 'basts.asset_id', '=', 'assets.id')
            ->leftJoin('employees', 'basts.employee_id', '=', 'employees.id')
            ->leftJoin('bast_files', 'basts.id', '=', 'bast_files.bast_id')
            ->select(
                'assets.*',
                'basts.id',
                'basts.asset_id',
                'basts.bast_number',
                'basts.bast_date',
                'basts.status',
                'employees.name as employee_name',
                'bast_files.document',
                'bast_files.photo'
            )
            ->where('basts.id', $bastId)
            ->where('basts.asset_id', $assetId)
            ->first();

        if (!$bast) {
            return redirect()->route('asset.detail', $assetId)->with('error', 'Data BAST tidak ditemukan.');
        }

        return view('pages.asset.bast.detail', compact('asset', 'bast'));
    }


    public function importForm()
    {
        return view('pages.asset.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Lewati baris header (anggap baris pertama header)
        foreach ($rows as $index => $row) {
            if ($index === 0) continue;

            // Ambil harga
            $price = isset($row[13]) ? $row[13] : 0;

            // Hapus .00 di belakang jika ada
            if (strpos($price, '.00') !== false) {
                $price = str_replace('.00', '', $price);
            }

            // Hanya angka
            $price = preg_replace('/\D/', '', $price);

            Asset::create([
                'sort_number'        => $row[0] ?? null,
                'item_code'          => $row[1] ?? '',
                'register'           => $row[2] ?? null,
                'name'               => $row[3] ?? null,
                'merk'               => $row[4] ?? null,
                'machine_number'     => $row[5] ?? null,
                'material'           => $row[6] ?? null,
                'acquisition_source' => $row[7] ?? null,
                'acquisition_year'   => $row[8] ?? null,
                'specification'      => $row[9] ?? null,
                'unit'               => $row[10] ?? null,
                'condition'          => $row[11] ?? null,
                'qty'                => $row[12] ?? 0,
                'price'              => $price ? (int)$price : 0,
                'notes'              => $row[14] ?? null,
            ]);
        }

        return redirect()->route('asset.index')->with('success', 'Data berhasil diimport!');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'sort_number' => 'nullable|string',
            'item_code' => 'required|string',
            'register' => 'nullable|integer',
            'merk' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'machine_number' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'acquisition_source' => 'nullable|string|max:255',
            'acquisition_year' => 'nullable|string',
            'specification' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:100',
            'condition' => 'string',
            'qty' => 'nullable|integer|min:0',
            'price' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        Asset::create($validated);

        return redirect()->route('asset.index')->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        return view('pages.asset.edit', compact('asset'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'item_code' => 'required|string',
            'sort_number' => 'nullable|string',
            'name' => 'nullable|string|max:255',
            'merk' => 'nullable|string|max:255',
            'machine_number' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'acquisition_source' => 'nullable|string|max:255',
            'acquisition_year' => 'nullable|date',
            'unit' => 'nullable|string|max:100',
            'condition' => 'required|string',
            'qty' => 'nullable|integer|min:0',
            'price' => 'nullable|integer|min:0',
            'specification' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $asset = Asset::findOrFail($id);
        $asset->update($validated);

        return redirect()->route('asset.index')->with('success', 'Data asset berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return response()->json(['success' => 'Data barang berhasil dihapus.']);
    }

    public function detail($id)
    {
        $asset = DB::table('assets')
            ->where('assets.id', $id)
            ->first();

        $bast = DB::table('basts')
            ->leftJoin('employees', 'basts.employee_id', '=', 'employees.id')
            ->leftJoin('bast_files', 'basts.id', '=', 'bast_files.bast_id')
            ->select(
                'basts.id',
                'basts.bast_number',
                'basts.bast_date',
                'basts.status',
                'employees.name as employee_name',
                'bast_files.document',
                'bast_files.photo'
            )
            ->where('basts.asset_id', $id)
            ->orderBy('basts.bast_date', 'desc')
            ->get();

        return view('pages.asset.detail', compact('asset', 'bast'));
    }


    public function createBast($assetId)
    {
        $asset = Asset::findOrFail($assetId);
        $employees = Employee::all();

        return view('pages.asset.bast.create', compact('asset', 'employees'));
    }

    public function storeBast(Request $request, $assetId)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bast_number' => 'required|string',
            'bast_date'   => 'required|date',
            'document'    => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ubah semua BAST sebelumnya untuk asset ini menjadi tidak aktif
        Bast::where('asset_id', $assetId)->update(['status' => 0]);

        // Simpan BAST baru otomatis status aktif
        $bast = Bast::create([
            'asset_id'    => $assetId,
            'employee_id' => $validated['employee_id'],
            'bast_number' => $validated['bast_number'],
            'bast_date'   => $validated['bast_date'],
            'status'      => 1, // otomatis aktif
        ]);

        // Simpan file jika ada
        if ($request->hasFile('document') || $request->hasFile('photo')) {
            BastFile::create([
                'bast_id'  => $bast->id,
                'document' => $request->file('document') ? $request->file('document')->store('bast/documents', 'public') : null,
                'photo'    => $request->file('photo') ? $request->file('photo')->store('bast/photos', 'public') : null,
            ]);
        }

        return redirect()->route('asset.detail', $assetId)
                        ->with('success', 'BAST baru berhasil dibuat dan diaktifkan.');
    }


}
