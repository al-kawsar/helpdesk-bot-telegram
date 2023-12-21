<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class BotController extends Controller
{

    public function addBot(Request $request)
    {
        $botData = $request->except('_token');
        $botData = $botData['keyBot'];

        $validator = Validator::make(
            ['apikey' => $botData],
            ['apikey' => 'required'],
            [
                'apikey.required' => 'API Key Wajib Di isi!!',
                'apikey.unique' => "Bot Sudah Ada Di Database,"
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $response = Http::get('https://api.telegram.org/bot' . $botData . '/getMe');
            $cekStatusBot = Http::get('https://api.telegram.org/bot' . $botData . '/getWebhookInfo');
            $dataStatus = $cekStatusBot->json();
            $statusBot = $cekStatusBot->status();
            $data = json_decode($response->body(), true);
            $statusCode = $response->status(); // Get the status code
            $botData = preg_replace('/\s+/', '', $botData);

            if ($statusCode == 404 || $statusBot == 404) {
                return redirect()->route('bot.botsettings')->with([
                    'failed_message' => "Bot Tidak Ditemukan!",
                    'title' => "Gagal"
                ]);
            }

            if ($statusCode == 401) {
                return redirect()->route('bot.botsettings')->withErrors([
                    'apikey' => "Pastikan token API bot Telegram yang Anda gunakan benar.",
                ])->withInput();
            }

            if ($response->successful() && $statusCode == 200) {
                $data = $data['result'];
                $dataStatus = $dataStatus['result']['url'];

                $checkIdBot = Bot::where('id_bot', $data['id'])->first();
                if ($checkIdBot) {
                    return redirect()->route('bot.botsettings')->with(['failed_message' => "Bot Sudah Ada Di Database!", 'title' => 'Gagal']);
                }

                if (!empty($dataStatus) || $dataStatus !== "") {
                    Http::post("https://api.telegram.org/bot{$botData}/deleteWebhook");
                }

                Bot::create([
                    'id' => Str::uuid(),
                    'apikey' => Crypt::encrypt($botData),
                    'id_bot' => $data['id'],
                    'first_name' => $data['first_name'],
                    'username' => $data['username'],
                    'status' => $status ?? '0'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->route('bot.botsettings')->with([
                'failed_message' => "{$e->getMessage()} $botData",
                'title' => "Gagal"
            ]);
        }

        return redirect()->route('bot.botsettings')->with([
            'success_message' => "Bot Berhasil Ditambahkan",
            'title' => "Berhasil"
        ]);
    }

    public function updateBot(Request $request, Bot $bot)
    {

        $apiBot = $request->keyBot;
        $validator = Validator::make(
            ['apikey-update' => $apiBot],
            ['apikey-update' => 'required',],
            [
                'apikey-update.required' => 'API Key Wajib Di isi!!',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        try {
            $response = Http::get('https://api.telegram.org/bot' . $apiBot . '/getMe');
            $data = json_decode($response->body(), true);
            $statusCode = $response->status(); // Get the status code
            $botData = preg_replace('/\s+/', '', $apiBot);
            $botData = Crypt::encrypt($botData);

            if ($statusCode == 404) {
                return redirect()->route('bot.botsettings')->with([
                    'failed_message' => "Bot Tidak Ditemukan! Perubahan Bot Gagal!",
                    'title' => "Gagal"
                ]);
            }

            if ($statusCode == 401) {
                return redirect()->route('bot.botsettings')->with([
                    'failed_message' => "Pastikan token API bot Telegram yang Anda gunakan benar.",
                    'title' => "Gagal"
                ]);
            }

            if ($response->successful() && $statusCode == 200) {
                $data = $data['result'];

                if (!empty($data)) {
                    Http::post("https://api.telegram.org/bot{$apiBot}/deleteWebhook");
                }

                if ($bot->id_bot == $data['id']) {
                    $bot->apikey = $botData;
                    $bot->id_bot = $data['id'];
                    $bot->first_name = $data['first_name'];
                    $bot->username = $data['username'];
                    $bot->save();

                    return redirect()->route('bot.botsettings')->with([
                        'success_message' => "Bot Berhasil Diubah!",
                        'title' => "Berhasil"
                    ]);
                } else {
                    $checkBot = Bot::where('id_bot', $data['id']);
                    if ($checkBot) {
                        return redirect()->route('bot.botsettings')->with([
                            'failed_message' => "Bot sudah ada di database!, perubahan gagal.",
                            'title' => "Gagal"
                        ]);
                    }

                    $bot->apikey = $botData;
                    $bot->id_bot = $data['id'];
                    $bot->first_name = $data['first_name'];
                    $bot->username = $data['username'];
                    $bot->save();

                    return redirect()->route('bot.botsettings')->with([
                        'success_message' => "Bot Berhasil Diubah!",
                        'title' => "Berhasil"
                    ]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('bot.botsettings')->with([
                'failed_message' => "{$e->getMessage()}",
                'title' => "Gagal"
            ]);
        }
    }


    public function destroyBot(Bot $bot)
    {
        try {
            $apiBot = Crypt::decrypt($bot->apikey);
            Bot::destroy($bot->id);
            Http::post("https://api.telegram.org/bot{$apiBot}/deleteWebhook");
            return redirect('/admin/bot-settings')->with(['success_message' => "Bot {$bot->username} telah dihapus", 'title' => "Berhasil"]);
        } catch (\Exception $e) {
            return redirect('/admin/bot-settings')->with(['success_message' => "{$e->getMessage()}", 'title' => "Gagal"]);
        }
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $status = Bot::whereIn('id', $ids)->delete();

        if (!$status) {
            return response()->json([
                'error' => true,
                'message' => "Bot Gagal Dihapus"
            ]);
        }

        return response()->json(
            [
                'success' =>  true,
                'message' => "Bot Berhasil Dihapus"
            ]
        );
    }

    public function setWebhook(Request $request, Bot $bot)
    {

        $validator = Validator::make(
            ['url' => $request->url],
            ["url" => 'url|required|regex:/^https:\/\/\S+$/i',],
            [
                'url.url' => 'url tidak valid!',
                'url.required' => 'url tidak boleh kosong',
                'url.regex' => 'url harus berupa https!'
            ]
        );

        if ($validator->fails()) {
            $errorMessages = implode(', ', $validator->errors()->all());
            return redirect()->back()->with([
                'failed_message' => "$errorMessages",
                'title' => 'Gagal'
            ]);
        }

        try {
            $apiBot = Crypt::decrypt($bot->apikey);
            $url = $request->input('url');

            $response = Http::post("https://api.telegram.org/bot{$apiBot}/setWebhook?url={$url}/webhook");
            $statusCode = $response->status();
            $data = $response->json();

            if ($statusCode == 200 && $response->successful()) {


                $chekBotActiveWebhook = Bot::where('status', '1')->first();
                if ($chekBotActiveWebhook) {
                    $apiCheck = Crypt::decrypt($chekBotActiveWebhook->apikey);
                    Http::post("https://api.telegram.org/bot{$apiCheck}/deleteWebhook");
                    Bot::where('status', '1')->update([
                        'status' => '0'
                    ]);
                }

                $bot->status = "1";
                $bot->save();
                return redirect()->route('bot.botsettings')->with([
                    'success_message' => "{$data['description']}",
                    'title' => 'Berhasil'
                ]);
            }

            if ($statusCode == 400) {
                return redirect()->route('bot.botsettings')->with([
                    'failed_message' => "{$data['description']}",
                    'title' => "Gagal"
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->route('bot.botsettings')->with([
                'failed_message' => "{$e->getMessage()}",
                'title' => 'Gagal'
            ]);
        }
    }

    public function deleteWebhook(Request $request, Bot $bot)
    {
        try {
            $apiBot = Crypt::decrypt($bot->apikey);
            $response = Http::post("https://api.telegram.org/bot{$apiBot}/deleteWebhook");
            $statusCode = $response->status();
            $data = $response->json();

            if ($statusCode == 404) {
                return redirect()->route('bot.botsettings')->with([
                    'failed_message' => "Kesalahan Token. Gagal!",
                    'title' => "Gagal"
                ]);
            }

            if ($statusCode == 401) {
                return redirect()->route('bot.botsettings')->with([
                    'failed_message' => "Token API bot Telegram salah!.",
                    'title' => "Gagal"
                ]);
            }
            if ($statusCode == 200 && $response->successful()) {
                $bot->status = "0";
                $bot->save();
                return redirect()->route('bot.botsettings')->with([
                    'success_message' => "{$data['description']}",
                    'title' => 'Berhasil'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->route('bot.botsettings')->with([
                'failed_message' => "{$e->getMessage()}",
                'title' => 'Gagal'
            ]);
        }
    }
}
