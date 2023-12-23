<?php

namespace App\Http\Controllers;

use App\Models\UserQuestion;
use Illuminate\Http\Request;

class RequestPertanyaan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Admin Request Pertanyaan";
        $teks = "Request Pertanyaan";
        $req_question = UserQuestion::latest()->paginate(10);

        return view('admin.request_users', compact('title', 'teks', 'req_question'));
    }

    public function verifikasiPertanyaan(Request $request)
    {
        $id_verifikasi = $request->id_verifikasi;
        try {

            UserQuestion::where('id', $id_verifikasi)->update([
                'status' => '2'
            ]);

            return response()->json([
                'success' => true,
                'message' => [
                    'title' => 'Berhasil',
                    'text' => 'Request pertanyaan telah diverifikasi'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => [
                    'text' => 'Error:' . $e->getMessage()
                ]
            ]);
        }
    }

    public function tolakPertanyaan(Request $request)
    {
    }

    public function hapusSemua(Request $request)
    {
        try {

            UserQuestion::destroy($request->ids);

            return response()->json([
                'success' => true,
                'message' => [
                    'title' => 'Berhasil',
                    'text' => 'Request pertanyaan berhasil dihapus'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => [
                    'title' => 'Gagal',
                    'text' => 'Request pertanyaan gagal dihapus'
                ]
            ]);
        }
    }
}
