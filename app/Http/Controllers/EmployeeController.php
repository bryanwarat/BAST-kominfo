<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Tampilkan halaman utama daftar pegawai.
     */
    public function index()
    {
        return view('pages.employee.index');
    }

    /**
     * Ambil data pegawai untuk DataTables.
     */
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('id', 'nip', 'name', 'skpd', 'position'); // Mengubah 'instansi' menjadi 'position'

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('employee.edit', $row->id);
                    $showUrl = route('employee.detail', $row->id);
                    $deleteUrl = route('employee.destroy', $row->id);

                    return '
                        <a href="'.$showUrl.'" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                        <a href="'.$editUrl.'" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fas fa-edit"></i></a>
                        <button onclick="deleteEmployee('.$row->id.')" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                        <form id="delete-form-'.$row->id.'" action="'.$deleteUrl.'" method="POST" style="display:none;">
                            '.csrf_field().method_field('DELETE').'
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Tampilkan formulir untuk membuat pegawai baru.
     */
    public function create()
    {
        return view('pages.employee.create');
    }

    /**
     * Simpan data pegawai baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip'       => 'required|unique:employees,nip|max:255',
            'name'      => 'required|max:255',
            'email'     => 'nullable|email|max:255',
            'phone'     => 'nullable|max:20',
            'skpd'      => 'nullable|max:255',
            'position'  => 'nullable|max:255',
        ]);

        Employee::create($request->all());

        return redirect()->route('employee.index')
                         ->with('success', 'Pegawai berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail pegawai.
     */
    public function detail(Employee $employee)
    {
        return view('pages.employee.detail', compact('employee'));
    }

    /**
     * Tampilkan formulir untuk mengedit pegawai.
     */
    public function edit(Employee $employee)
    {
        return view('pages.employee.edit', compact('employee'));
    }

    /**
     * Perbarui data pegawai.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nip'       => ['required', 'max:255', Rule::unique('employees')->ignore($employee->id)],
            'name'      => 'required|max:255',
            'email'     => 'nullable|email|max:255',
            'phone'     => 'nullable|max:20',
            'skpd'      => 'nullable|max:255',
            'position'  => 'nullable|max:255',
        ]);

        $employee->update($request->all());

        return redirect()->route('employee.index')
                         ->with('success', 'Data pegawai berhasil diperbarui!');
    }

    /**
     * Hapus pegawai.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employee.index')
                         ->with('success', 'Pegawai berhasil dihapus!');
    }
}