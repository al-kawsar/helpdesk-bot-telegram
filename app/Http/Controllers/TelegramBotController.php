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
    public function botAction(Request $request)
    {
        $grup = $request->input('grup');

        $request->validate([
            'grup' => 'required',
            'pesan' => 'required',
        ], [
            'grup.required' => 'Parameter grup wajib diisi.',
            'pesan.required' => 'Pesan wajib diisi.'
        ]);

        // return 
        try {
            Telegram::sendMessage([
                'chat_id' => $grup,
                'text' => $request->input('pesan')
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('bot.grup')->with('success_message', 'Pesan berhasil terkirim!');
        } catch (\Exception $e) {
            return redirect()->route('bot.grup')->with(
                [
                    'failed_message' => "Error {$e->getMessage()}",
                    'title' => "Gagal Mengirim Pesan!"
                ]
            );
        }
    }

    public function botInfo()
    {
        return 'ini halaman info bot';
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

    public function setWebhook()
    {
        // Set the webhook URL
        Telegram::setWebhook([
            'url' => 'http://yourserver.com/telegram-bot',
        ]);

        return 'ok';
    }

    // public function OnBot()
    // {
    //     $this->botStatus = 'aktif';
    //     return redirect()->back()->with(['success_message' => "Bot Berhasil Dinyalakan", 'title' => "Berhasil!!"]);
    // }

    // public function OffBot()
    // {
    //     $this->botStatus = 'mati';
    //     return redirect()->back()->with(['success_message' => "Bot Berhasil Dimatikan", 'title' => "Berhasil!!"]);
    // }


    private $id_bot = 5992144298;
    public function handleBot(Request $request)
    {

        $update = $request->all();


        // Cek Bot Jika Dimasukkan Di Grup Baru
        if (isset($update['my_chat_member']['new_chat_member'])) {
            $newChatMember = $update['my_chat_member']['new_chat_member'];
            $chat = $update['my_chat_member']['chat'];

            $id_bot = $this->id_bot;

            $check_id_bot = $newChatMember['user']['id'];
            $statusBot = $newChatMember['status'];

            $id_grup = $chat['id'];
            $nama_grup = $chat['title'];
            $username_grup = $chat['username'] ?? '';
            $tipe_grup = $chat['type'];

            if ($statusBot !== 'left') {
                if ($id_bot === $check_id_bot) {
                    $checkIdGrup = Group::where('id_grup', $id_grup)->first();
                    if (!$checkIdGrup) {
                        Group::create([
                            'id_grup' => $id_grup,
                            'nama_grup' => $nama_grup,
                            'username' => $username_grup,
                            'tipe_grup' => $tipe_grup
                        ]);
                    }
                }
            } else {
                $message = "grup dihapus\nid_grup:{$id_grup}\nnama_grup:{$nama_grup}";
                Group::where('id_grup', $id_grup)->delete();
            }
        }


        if (isset($update["message"]['text'])) {

            $msg = $update['message'];
            $chat_id = $msg["chat"]["id"];
            $message = $msg['text'];
            $msg_id = $msg['message_id'];
            $userId = $msg['from']['id'];
            $first_name = $msg['from']['first_name'];
            $last_name = isset($msg['from']['last_name']) ? $msg['from']['last_name'] : null;
            $username = $update['message']['from']['username'];

            $checkGrup = Group::where("id_grup", $chat_id)->first();
            if ($update['message']['chat']['type'] !== 'private' && !$checkGrup) {
                Group::create([
                    'id_grup' => $chat_id,
                    'username' => $update['message']['chat']['username'] ?? '',
                    'nama_grup' => $update['message']['chat']['title'],
                    'tipe_grup' => $update['message']['chat']['type']
                ]);
            }

            $checkUser = TelegramUser::where("chat_id", $userId)->first();
            if (!$checkUser) {
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
                Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_to_message_id' => $msg_id
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
                Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_markup' => json_encode($keyboard),
                    'reply_to_message_id' => $msg_id
                ]);
            }
        }

        // callback query

        if (isset($update["callback_query"])) {
            $callbackQuery = $update["callback_query"];
            $chat_id = $callbackQuery["message"]["chat"]["id"];
            $msg_id = $update['callback_query']['message']['message_id'];
            $data = $callbackQuery["data"];
            [$type, $id] = explode('-', $data);

            if ($type === "kategori") {
                $Kategori = Kategori::with('subKategori')->find($id);
                $keyboard = self::generateInlineKeyboard($Kategori->subKategori, 'id', 'subKategori');
                if ($Kategori->subKategori->isNotEmpty()) {
                    $message = "-> Sub-Kategoris $Kategori->kategori\n\n";
                    foreach ($Kategori->subKategori as $number => $subKategori) {
                        $message .= ($number + 1) . ". {$subKategori->sub_kategori}\n";
                    }
                } else {
                    $message = "Maaf, Sub Kategori $Kategori->kategori Belum Tersedia";
                }
                Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_markup' => json_encode($keyboard),
                    // 'reply_to_message_id' => $msg_id
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

                Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_markup' => json_encode($keyboard),
                    // 'reply_to_message_id' => $msg_id
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
                Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'reply_markup' => json_encode($keyboard),
                    // 'reply_to_message_id' => $msg_id
                ]);
            } else if ($type === "pertanyaan") {
                $pertanyaan = Pertanyaan::find($id)->jawaban;
                if ($pertanyaan) {
                    $message = "-> Jawaban\n\n";
                    $message .= $pertanyaan;

                    Telegram::sendMessage([
                        'chat_id' => $chat_id,
                        'text' => $message,
                        // 'reply_to_message_id' => $msg_id
                    ]);
                }
            }
        }
        // else {
        //     if ($this->botStatus == 'perbaikan' && isset($update["message"])) {
        //         $chat_id = $update["message"]["chat"]["id"];
        //         Telegram::sendMessage([
        //             'chat_id' => $chat_id,
        //             'text' => 'Mohon Maaf, Bot Sedang Di Perbaiki',
        //         ]);
        //     } elseif ($this->botStatus == 'mati' && isset($update["message"])) {
        //         $chat_id = $update["message"]["chat"]["id"];
        //         Telegram::sendMessage([
        //             'chat_id' => $chat_id,
        //             'text' => 'Bot mati',
        //         ]);
        //     }
        // }

        return response('ok');
    }

    // private function Telegram(string $method, $parameters)
    // {
    //     $url = "https://api.telegram.org/bot{$}/$method";  

    //     $options = array(
    //         'http' => [
    //             'header' => "Content-type: application/x-www-form-urlencoded\r\n",
    //             'method' => 'POST',
    //             'content' => http_build_query($parameters),
    //         ],
    //     );

    //     $context = stream_context_create($options);
    //     $result = file_get_contents($url, false, $context);

    //     return $result;
    // }
}
