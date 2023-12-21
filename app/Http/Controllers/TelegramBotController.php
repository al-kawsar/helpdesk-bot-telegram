<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessageQueue;
use App\Models\Bot;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Pertanyaan;
use App\Models\SubKategori;
use App\Models\SubSubKategori;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class TelegramBotController extends Controller
{

    public function botAction(Request $request)
    {
        $grup = $request->input('grup');
        $pesan = $request->input('pesan');

        $request->validate([
            'grup' => 'required',
            'pesan' => 'required',
        ], [
            'grup.required' => 'Parameter grup wajib diisi.',
            'pesan.required' => 'Pesan wajib diisi.'
        ]);

        // return redirect()->route('bot.grup')->with([
        //     'success_message' => "Pesan Sedang Dikirim!",
        //     'title' => "Berhasil"
        // ]);
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

        try {
            $update = $request->all();
            $bot = Bot::where('status', '1')->first();

            // Cek Bot Jika Dimasukkan Di Grup Baru
            if (isset($update['my_chat_member']['new_chat_member'])) {
                $newChatMember = $update['my_chat_member']['new_chat_member'];
                $chat = $update['my_chat_member']['chat'];

                $statusBot = $newChatMember['status'];

                $id_grup = $chat['id'];
                $nama_grup = $chat['title'];

                if ($statusBot === 'left') {
                    $message = "grup dihapus\nid_grup:{$id_grup}\nnama_grup:{$nama_grup}";
                    Group::where('id_grup', $id_grup)->delete();
                }
            }

            if (isset($update['message'])) {

                $id_grup = $update['message']['chat']['id'];
                $nama_grup = $update['message']['chat']['title'] ?? "";
                $tipe_grup = $update['message']['chat']['type'];
                $username_grup = $update['message']['chat']['username'] ?? '';

                if (isset($update['message']['new_chat_member'])) {
                    $newChatMember = $update['message']['new_chat_member'];
                    $idCheck = $newChatMember['id'];

                    if ($idCheck == $bot['id_bot']) {
                        Group::create([
                            'id_grup' => $id_grup,
                            'nama_grup' => $nama_grup,
                            'username' => $username_grup,
                            'tipe_grup' => $tipe_grup,
                            'bot_id' => $bot['id'],
                        ]);
                    }
                }

                if (isset($update['message']['group_chat_created'])) {
                    Group::create([
                        'id_grup' => $id_grup,
                        'nama_grup' => $nama_grup,
                        'username' => $username_grup,
                        'tipe_grup' => $tipe_grup,
                        'bot_id' => $bot['id'],
                    ]);
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
                $type = $update['message']['chat']['type'];

                $checkGrup = Group::where("id_grup", $chat_id)->first();
                if ($type !== 'private' && !$checkGrup) {
                    Group::create([
                        'id_grup' => $chat_id,
                        'username' => $update['message']['chat']['username'] ?? '',
                        'nama_grup' => $update['message']['chat']['title'],
                        'tipe_grup' => $update['message']['chat']['type'],
                        'bot_id' => $bot['id'],
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

                if ($message === "/start" || $message === '/start@' . $bot['username']) {
                    $message = "Halo saya adalah bot Helpdesk ketik atau klik -> [/help] untuk melihat detail informasi";
                    // $message .= "\n Bot Active : {$bot['id']}";
                    self::Telegram('sendMessage', [
                        'chat_id' => $chat_id,
                        'text' => $message,
                        'reply_to_message_id' => $msg_id
                    ]);
                } else if ($message === "/help" || $message === '/help@' . $bot['username']) {
                    if ($type === 'private') {
                        $kategoris = Kategori::where('id_grup', 'private')->with('subKategori')->latest()->paginate(9);
                    } else {
                        $kategoris = Kategori::where('id_grup', $chat_id)->with('subKategori')->latest()->paginate(20);
                    }
                    $keyboard = self::generateInlineKeyboard($kategoris, 'id', 'kategori');
                    if ($kategoris->isNotEmpty()) {
                        $message = "-> KATEGORIS \n\n";
                        foreach ($kategoris as $number => $kategori) {
                            $message .= ($number + 1) . ". {$kategori['kategori']}\n";
                        }
                    } else {
                        $message = "Maaf, Kategori Masih Kosong Atau Belum Ditambahkan ";
                    }
                    $this->Telegram('sendMessage', [
                        'chat_id' => $chat_id,
                        'text' => $message,
                        'reply_markup' => json_encode($keyboard),
                        'reply_to_message_id' => $msg_id,
                    ]);
                } else {
                    $message = "Perintah tidak di mengerti";
                    $this->Telegram('sendMessage', [
                        'chat_id' => $chat_id,
                        'text' => $message,
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
                    $this->Telegram('editMessageText', [
                        'chat_id' => $chat_id,
                        'text' => $message,
                        'message_id' => $msg_id,
                        'reply_markup' => json_encode($keyboard),

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
                    $this->Telegram('editMessageText', [
                        'chat_id' => $chat_id,
                        'text' => $message,
                        'message_id' => $msg_id,
                        'reply_markup' => json_encode($keyboard),
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
                    $this->Telegram('editMessageText', [
                        'chat_id' => $chat_id,
                        'text' => $message,
                        'message_id' => $msg_id,
                        'reply_markup' => json_encode($keyboard),
                    ]);
                } else if ($type === "pertanyaan") {
                    $pertanyaan = Pertanyaan::find($id);
                    if ($pertanyaan) {

                        $total = $pertanyaan->total_pertanyaan;
                        $total += "1";

                        $pertanyaan->total_pertanyaan = $total;
                        $pertanyaan->save();

                        $message = "-> Jawaban\n\n";
                        $message .= $pertanyaan->jawaban;

                        $this->Telegram('editMessageText', [
                            'chat_id' => $chat_id,
                            'text' => $message,
                            'message_id' => $msg_id,
                        ]);
                    }
                }
            }
            return response('ok');
        } catch (\Exception $e) {
            return Log::info($e->getMessage());
        }
    }

    protected function Telegram(string $method, $parameters)
    {
        $token = Bot::where('status', '1')->first();

        $token = Crypt::decrypt($token['apikey']);
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
}
