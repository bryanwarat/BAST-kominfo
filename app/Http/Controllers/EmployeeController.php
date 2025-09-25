<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('pages.employee.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('employee.edit', $row->id);
                    $showUrl = route('employee.detail', $row->id);
                    $deleteUrl = route('employee.destroy', $row->id);

                    return '
                        <a href="'.$showUrl.'" class="btn btn-sm btn-primary">Detail</a>
                        <a href="'.$editUrl.'" class="btn btn-sm btn-warning">Edit</a>
                        <button onclick="deleteEmployee('.$row->id.')" class="btn btn-sm btn-danger">Hapus</button>
                        <form id="delete-form-'.$row->id.'" action="'.$deleteUrl.'" method="POST" style="display:none;">
                            '.csrf_field().method_field('DELETE').'
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function create()
    {
        return view('pages.employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip'   => 'required',
            'name'  => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        Employee::create([
            'nip'    => $request->nip,
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'status' => 1, // otomatis aktif
        ]);

        return redirect()->route('employee.index')
                        ->with('success', 'Pegawai berhasil ditambahkan!');
    }


    // Halaman detail
    public function detail($id)
    {
        $employee = Employee::findOrFail($id);
        return view('pages.employee.detail', compact('employee'));
    }

    // Halaman edit
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('pages.employee.edit', compact('employee'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'nip'   => 'required|unique:employees,nip,' . $employee->id,
            'name'  => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'status'=> 'required|in:0,1', // bisa diubah manual
        ]);

        // Update data pegawai
        $employee->update([
            'nip'    => $request->nip,
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'status' => 1,
        ]);

        return redirect()->route('employee.index')
                        ->with('success', 'Pegawai berhasil diupdate!');
    }


    // Delete
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()
            ->route('employee.index')
            ->with('success', 'Pegawai berhasil dihapus!');
    }

}
