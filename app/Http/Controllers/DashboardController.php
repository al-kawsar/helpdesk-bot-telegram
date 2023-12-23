<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\UserQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DashboardController extends Controller
{

    public function pageIndex()
    {
        $title = 'Home';
        $teks = 'anjay';
        $lists = Pertanyaan::orderBy('total_pertanyaan', 'desc') // Mengurutkan berdasarkan total_pertanyaan secara descending (terbesar ke terkecil)
            ->limit(6) // Membatasi jumlah hasil yang diambil menjadi 6
            ->get();
        return view('v_home', compact('title', 'teks', 'lists'));
    }

    public function pertanyaan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'pertanyaan' => 'required'
        ], [
            'nama.required' => 'nama wajib di isi!',
            'username.required' => 'username wajib di isi!',
            'pertanyaan.required' => 'pertanyaan wajib di isi!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userQuestion = new UserQuestion();

            $token = self::generateToken(model: $userQuestion);

            // check token ketika ada yang sama
            $token = $userQuestion->where('token', $token)->first() ? self::generateToken(model: $userQuestion) : $token;
            $text = "Tim kami sedang melakukan proses verifikasi terhadap pengajuan yang Anda berikan. Proses ini dapat memerlukan beberapa waktu";

            $userQuestion->create([
                'nama' => request('nama'),
                'username' => request('username'),
                'pertanyaan' => request('pertanyaan'),
                'response' => $text,
                'token' => $token
            ]);

            return response()->json([
                'success' => true,
                'message' => [
                    'title' => "Berhasil",
                    'text' => 'Pertanyaan anda berhasil terkirim.'
                ],
                'token' => $token
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => [
                    'title' => "Gagal",
                    'text' => $e->getMessage()
                ],
            ]);
        }
    }

    public function checkToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ], [
            'token.required' => 'token wajib di isi!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {

            $reqRespon = UserQuestion::where('token', $request->token)->first();

            if (!$reqRespon) {
                return response()->json([
                    'error' => true,
                    'message' => [
                        'title' => "Tidak Terdapat Pengajuan, Pastikan Token yang Anda Input Sesuai",
                    ],
                ], 200);
            }

            $status = $reqRespon->status;
            $text = $reqRespon->response;
            if ($status === '1') {
                $status = 'Menunggu';
            } elseif ($status === '2') {
                $status = 'Diterima';
            } elseif ($status === '3') {
                $status = 'Ditolak';
            } else {
                $status = "Status tidak diketahui";
            }

            return response()->json([
                'success' => true,
                'message' => [
                    'title' => "Status : {$status}",
                    'text' => $text ?? 'ini respon'
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => [
                    'title' => "Gagal",
                    'text' => $e->getMessage()
                ],
            ]);
        }
    }

    private function generateToken(Model $model): string
    {
        $Uniqkey = ($model->count() + 1) * 123;
        return "BOT/{$Uniqkey}/ICT/" . random_int(0, ($Uniqkey * 671));
    }
}
