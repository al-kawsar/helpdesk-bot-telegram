<?php

namespace App\Jobs;

use App\Models\Kategori;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaginateKategoriJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $data = Kategori::paginate(20); // Ubah YourModel dengan model yang sesuai
        info("Queue : $data");
        // Proses data atau lakukan apa pun yang Anda butuhkan
        return $data;
    }
}
