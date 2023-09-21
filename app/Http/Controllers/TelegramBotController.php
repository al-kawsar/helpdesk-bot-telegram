<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\Group;
use App\Models\Pertanyaan;
use App\Models\SubKategori;
use App\Models\SubSubKategori;
use App\Models\TelegramUser;

class TelegramBotController extends Controller
{

    private function Telegram(string $method, $parameters)
    {
        $token = $_ENV['TELEGRAM_BOT_TOKEN'];
        $url = "https://api.telegram.org/bot{$token}/$method";

        $options = array(
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($parameters),
            ],
        );

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }

    public function generateInlineKeyboard($items, $callbackKey, $type, $buttonsPerRow = 3)
    {
        $keyboard = ['inline_keyboard' => []];
        $columnCount = 0;
        $row = [];

        foreach ($items as $key => $item) {
            $row[] = [
                'text' => "Pilih " . ($key + 1),
                'callback_data' => "{$type}-{$item[$callbackKey]}"
            ];
            $columnCount++;

            if ($columnCount >= $buttonsPerRow) {
                $keyboard['inline_keyboard'][] = $row;
                $row = [];
                $columnCount = 0;
            }
        }
        if (!empty($row)) {
            $keyboard['inline_keyboard'][] = $row;
        }
        return $keyboard;
    }

    public function handleBot(Request $request)
    {
        $update = Telegram::getUpdates();

        // Cek Bot Jika Dimasukkan Di Grup Baru
        if (isset($update['new_chat_member']['status']) && $update['new_chat_member']['status'] === "administrator") {
            $id_bot = 5992144298;
            $newChatMember = $update['my_chat_member']['new_chat_member'];
            $chat = $update['my_chat_member']['chat'];

            $id_grup = $chat['id'];
            $nama_grup = $chat['title'];
            $tipe_grup = $chat['type'];
            $check_id_bot = $newChatMember['user']['id'];

            if ($id_bot === $check_id_bot) {
                $checkIdGrup = Group::where('id_grup', $id_grup)->first();
                if (!$checkIdGrup) {
                    Group::create([
                        'id_grup' => $id_grup,
                        'nama_grup' => $nama_grup,
                        'tipe_grup' => $tipe_grup
                    ]);
                }
            }
        }


        // if (isset($update['my_chat_member']))

        if (isset($update["message"])) {
            $chat_id = $update["message"]["chat"]["id"];
            $message = $update['message']['text'];
            $userId = $update['message']['from']['id'];
            $first_name = $update['message']['from']['first_name'];
            $last_name = $update['message']['from']['last_name'];
            $username = $update['message']['from']['username'];

            $checkUser = TelegramUser::where("chat_id", $userId)->first();

            if ($checkUser === null) {
                TelegramUser::create([
                    'chat_id' => $userId,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'username' => $username,
                ]);
            }


            if ($message === "/start" || $message === "/start@helpdesk_camaba_bot") {
                $message = "from : @$username\n";
                $message .= "Halo saya adalah bot Helpdesk ketik atau klik -> [/help] untuk melihat detail informasi";
                self::Telegram('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => $message
                ]);
            }
            if ($message === "/help" || $message === "/help@helpdesk_camaba_bot") {
                $kategoris = Kategori::with('subKategori')->latest()->paginate(20);
                $keyboard = self::generateInlineKeyboard($kategoris, 'id', 'kategori');
                if ($kategoris->isNotEmpty()) {
                    $message = "-> KATEGORIS \n\n";
                    foreach ($kategoris as $number => $kategori) {
                        $message .= ($number + 1) . ". {$kategori['kategori']}\n";
                    }
                } else {
                    $message = "Maaf, Kategori Masih Kosong Atau Belum Ditambahkan ";
                }
                self::Telegram('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_markup' => json_encode($keyboard)
                ]);
            }
        }

        // callback query

        if (isset($update["callback_query"])) {
            $callbackQuery = $update["callback_query"];
            $chat_id = $callbackQuery["message"]["chat"]["id"];
            $data = $callbackQuery["data"];
            [$type, $id] = explode('-', $data);

            if ($type === "kategori") {
                $Kategori = Kategori::with('subKategori')->find($id);
                $keyboard = self::generateInlineKeyboard($Kategori->subKategori, 'id', 'subKategori');
                if ($Kategori->subKategori->isNotEmpty()) {
                    $message = "-> Sub-Kategoris\n\n";
                    foreach ($Kategori->subKategori as $number => $subKategori) {
                        $message .= ($number + 1) . ". {$subKategori->sub_kategori}\n";
                    }
                } else {
                    $message = "Maaf, Sub Kategori $Kategori->kategori Belum Tersedia";
                }
                self::Telegram('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_markup' => json_encode($keyboard)
                ]);
            } else if ($type === "subKategori") {
                $subKategori = SubKategori::with('subSubKategori')->find($id);
                $keyboard = self::generateInlineKeyboard($subKategori->subSubKategori, 'id', 'subSubKategori');
                if ($subKategori->subSubKategori->isNotEmpty()) {
                    $message = "-> Sub-Sub-Kategoris\n\n";
                    foreach ($subKategori->subSubKategori as $number => $subSubKategori) {
                        $message .= ($number + 1) . ". {$subSubKategori->sub_sub_kategori}\n";
                    }
                } else {
                    $message = "Maaf, Sub Sub Kategori {$subKategori->sub_kategori} Belum Tersedia";
                }

                self::Telegram('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_markup' => json_encode($keyboard)
                ]);
            } else if ($type === "subSubKategori") {
                $subSubKategori = SubSubKategori::with('pertanyaan')->find($id);
                $keyboard = $this->generateInlineKeyboard($subSubKategori->pertanyaan, 'id', 'pertanyaan');
                if ($subSubKategori->pertanyaan->isNotEmpty()) {
                    $message = "-> Pertanyaan\n\n";
                    foreach ($subSubKategori->pertanyaan as $number => $pertanyaan) {
                        $message .= ($number + 1) . ". $pertanyaan->pertanyaan\n";
                    }
                } else {
                    $message = "Maaf, Pertanyaan {$subSubKategori->sub_sub_kategori} Belum Tersedia ";
                }
                self::Telegram('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_markup' => json_encode($keyboard)
                ]);
            } else if ($type === "pertanyaan") {
                $pertanyaan = Pertanyaan::find($id)->jawaban;
                if ($pertanyaan) {
                    $message = "-> Jawaban\n\n";
                    $message .= $pertanyaan;

                    self::Telegram('sendMessage', [
                        'chat_id' => $chat_id,
                        'text' => $message,
                        'reply_markup' => json_encode($keyboard)
                    ]);
                }
            }
        }

        return response('success'); // Balas dengan 'ok' untuk menandakan penerimaan update yang sukses
    }
}
