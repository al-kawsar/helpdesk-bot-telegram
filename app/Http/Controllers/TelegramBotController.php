<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\Group;


class TelegramBotController extends Controller
{

    public function infoWebhook()
    {
        $response = Telegram::getWebhookInfo();

        return response()->json($response);
    }

    public function getInfoBot()
    {
        $response = Telegram::getMe();

        return response()->json($response);
    }

    public function getUpdates()
    {
        $response = Telegram::getUpdates();

        return response()->json($response);
    }

    public function setWebhook()
    {
        $response = Telegram::setWebhook([
            'url' => url("https://e140-140-213-178-200.ngrok-free.app/admin/webhook")
        ]);

        if ($response != 1 || $response != true) {
            session()->flash('success_message', "Bot Sudah Dinyalakan");
            session()->flash('title', "Berhasil!!");
            // return redirect()->back();
        }

        session()->flash('success_message', "Bot Berhasil Dinyalakan");
        session()->flash('title', "Berhasil!!");

        return redirect()->back();
    }

    public function deleteWebhook()
    {
        $response = Telegram::removeWebhook();
        if ($response != 1 || $response != true) {
            session()->flash('success_message', "Bot gagal Dinyalakan");
            session()->flash('title', "Gagal!!");
            return redirect()->back();
        }

        session()->flash('success_message', "Bot Berhasil Dimatikan");
        session()->flash('title', "Berhasil!!");

        return redirect()->back();
    }

    public function webhook(Request $request)
    {
        $update = Telegram::getWebhookUpdate();

        if (isset($update["message"])) {
            $chat_id = $update["message"]["chat"]["id"];
            $message = $update['message']['text'];
            $chat_type = $update["message"]["chat"]["type"];

            if ($chat_type === 'private') {
                if ($message === '/start') {
                    $message = "Hai, saya bot helpdesk! Gunakan perintah /help untuk melihat daftar menu pertanyaan yang tersedia";
                }
            } else {

                $group_id = $chat_id;
                $group_title = $update["message"]["chat"]["title"];

                $checkIdGrup = Group::where('id_grup', $group_id)->first();
                if (!$checkIdGrup) {
                    Group::create([
                        'id_grup' => $group_id,
                        'nama_grup' => $group_title
                    ]);
                }
                if ($message === "/help") {
                    $result = Kategori::with('subKategori')->latest()->paginate(20);
                    $keyboard = [
                        'inline_keyboard' => []
                    ];
                    if (!empty($result)) {
                        $message = "-> KATEGORIS \n";
                        $keyboard = [
                            'inline_keyboard' => []
                        ];
                        //  * inisialisasi awal sebuah kolom
                        $columnCount = 0;
                        $row = [];

                        foreach ($result as $key => $kategori) {
                            $row[] = [
                                'text' => "{$kategori['kategori']}",
                                'callback_data' => "{$kategori['id']}"
                            ];
                            $columnCount++;
                            if ($columnCount >= 3) {
                                $keyboard['inline_keyboard'][] = $row;
                                $row = [];
                                $columnCount = 0;
                            }
                        }

                        // Jika ada sisa item yang belum ditambahkan, tambahkan ke baris terakhir
                        if (!empty($row)) {
                            $keyboard['inline_keyboard'][] = $row;
                        }

                        return Telegram::sendMessage([
                            'chat_id' => $chat_id,
                            'text' => $message,
                            'reply_markup' => json_encode($keyboard)
                        ]);
                    }
                }
            }


            Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => $message,
            ]);
        }
        // Tangani callback query atau pesan lainnya jika diperlukan

        return response('ok'); // Balas dengan 'ok' untuk menandakan penerimaan update yang sukses
    }
}
