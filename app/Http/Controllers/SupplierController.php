<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;

class SupplierController extends Controller
{
    public function index(){
        
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object)[
            'title' => 'Daftar Supplier yang terdaftar dalam sistem'
        ];

        $supplier = SupplierModel::all();  //ambil data supplier untuk filter supplier

        $activeMenu = 'supplier'; //set menu yang sedang active

        return view('supplier.index_supplier', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu]);
          
    }    

    public function list(Request $request)
    {
        // Ambil data supplier
        $suppliers = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat');

        // Return data untuk DataTables
        return DataTables::of($suppliers)
            ->addIndexColumn() // menambahkan kolom index / nomor urut
            ->addColumn('aksi', function ($supplier) {
                // Menambahkan kolom aksi untuk edit, detail, dan hapus
                // $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                // return $btn;

                $btn = '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    public function create(){

        $breadcrumb = (object)[
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Supplier Baru'
        ];

        $activeMenu = 'supplier'; //set menu yang sedang aktif

        return view('supplier.create_supplier', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request){
        
        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'supplier_nama' => 'required|string|min:3|max:100',
                'supplier_kode' => 'required|string|min:3|max:10|unique:m_supplier,supplier_kode',
                'supplier_alamat' => 'required|string|min:5|max:255',
            ]
            );

        // Mengubah username menjadi kapital
        $supplier_kode = strtoupper($request->supplier_kode);

        SupplierModel::create([
            'supplier_nama' =>$request->supplier_nama,
            'supplier_kode' => $supplier_kode,
            'supplier_alamat' =>$request->supplier_alamat
        ]);

        return redirect('/supplier')->with('success', 'Data user berhasil disimpan');
    }

    public function edit(string $id){
        
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Supplier'
        ];

        $activeMenu = 'supplier'; //set menu yang sedang aktif

        return view('supplier.edit_supplier', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request,string $id){

        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'supplier_nama' => 'required|string|min:3|max:100',
                'supplier_kode' => 'required|string|min:3|max:10|unique:m_supplier,supplier_kode,'.$id.',supplier_id',
                'supplier_alamat' => 'required|string|min:5|max:255',
            ]
            );
        
            // Mengubah username menjadi kapital
        $supplier_kode = strtoupper($request->supplier_kode);

        SupplierModel::find($id)->update([
            'supplier_nama' =>$request->supplier_nama,
            'supplier_kode' => $supplier_kode,
            'supplier_alamat' =>$request->supplier_alamat
        ]);


        return redirect('/supplier')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id){

        $check = SupplierModel::find($id);
        if (!$check) {
            return redirect('/supplier')->with('error', 'Data supplier Tidak ditemukan');
        }

        try{
            SupplierModel::destroy($id);

            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            
            return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang berkaitan');
        }
    }

    // 1. public function create_ajax()
    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }

    // 2. public function store_ajax(Request $request)
    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode'    => 'required|string|min:3|unique:m_supplier,supplier_kode',
                'supplier_nama'    => 'required|string|max:100',
                'supplier_alamat'  => 'required|string|max:100',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            SupplierModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data supplier berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    // 3. public function edit_ajax(string $id)
    public function edit_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.edit_ajax', ['supplier' => $supplier]);
    }

    // 4. public function update_ajax(Request $request, $id)
    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|max:20|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
                'supplier_nama' => 'required|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
                'supplier_alamat' => 'required|string|max:100',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = SupplierModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // 5. public function confirm_ajax(string $id)
    public function confirm_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.confirm_ajax', ['supplier' => $supplier]);
    }

    // 6. public function delete_ajax(Request $request, $id)
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = SupplierModel::find($id);
            if ($supplier) {
                $supplier->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function import()
    {
        return view('supplier.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
        // validasi file harus xls atau xlsx, max 1MB
                'file_supplier' => ['required', 'mimes:xlsx', 'max:1024'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $file = $request->file('file_supplier'); // ambil file dari request
            $reader = IOFactory::createReader('Xlsx'); // load reader file excel
            $reader->setReadDataOnly(true); // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
            $data = $sheet->toArray(null, false, true, true); // ambil data excel
            $insert = [];
            if (count($data) > 1) { // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'supplier_id' => $value['A'],
                            'supplier_kode' => $value['B'],
                            'supplier_nama' => $value['C'],
                            'supplier_alamat' => $value['D'],
                        ];
                    }
                }
                if (count($insert) > 0) {
            // insert data ke database, jika data sudah ada, maka diabaikan
                    SupplierModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport',
                ]);
            }
        }
        return redirect('/');
    }

    public function export_excel()
    {
        //ambil data yang akan di export
        $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->orderBy('supplier_kode')
            ->get();

        //load library
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Supplier');
        $sheet->setCellValue('C1', 'Nama Supplier');
        $sheet->setCellValue('D1', 'Alamat Supplier');

        $sheet->getStyle('A1:C1')->getFont()->setBold(true); //bold header

        $no = 1;
        $baris = 2;
        foreach ($supplier as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->supplier_kode);
            $sheet->setCellValue('C' . $baris, $value->supplier_nama);
            $sheet->setCellValue('D' . $baris, $value->supplier_alamat);
            $baris++;
            $no++;

        }

        foreach (range('A', 'D') as $columID) {
            $sheet->getColumnDimension($columID)->setAutoSize(true); //set auto size kolom
        }

        $sheet->setTitle('Data Supplier');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Supplier ' . date('Y-m-d H:i:s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, dMY H:i:s') . 'GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit;

    }

    public function export_pdf(){
         //ambil data yang akan di export
         $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
         ->orderBy('supplier_kode')
         ->get();

         //use Barruvdh\DomPDF\Facade\\Pdf
        $pdf = Pdf::loadView('supplier.export_pdf', ['supplier' =>$supplier]);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();

        return $pdf->download('Data Supplier '.date('Y-m-d H:i:s').'.pdf');
    }


}
