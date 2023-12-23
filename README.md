# Aplikasi Web Bot Telegram dengan Laravel

<!-- ![Logo Aplikasi](link_ke_logo.png) -->

Proyek ini adalah implementasi sebuah aplikasi web bot yang berintegrasi dengan platform Telegram, dibangun menggunakan framework Laravel. Aplikasi ini dirancang untuk memberikan pengguna kemampuan untuk berinteraksi dengan bot melalui platform Telegram, sehingga memungkinkan mereka untuk melakukan berbagai tugas dan mendapatkan informasi dengan mudah melalui obrolan.

Pastikan Anda telah menginstal:

-   PHP (^8.1)
-   Composer
-   MySQL

## Setup & Konfigirasi

1. Clone repositori ini ke direktori lokal Anda:

    ```bash
    git clone https://github.com/andirhn/Aplikasi-Web-Bot-Telegram-Dengan-Laravel.git
    ```

2. Masuk ke direktori proyek:

    ```bash
    cd Aplikasi-Web-Bot-Telegram-Dengan-Laravel
    ```

3. Instal dependencies menggunakan Composer:

    ```bash
    composer install
    ```

4. Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

5. Konfigurasi file `.env` dengan informasi database Anda.

6. Generate key aplikasi Laravel:

    ```bash
    php artisan key:generate
    ```

7. Jalankan migrasi database untuk membuat skema tabel beserta seeder:

    ```bash
    php artisan migrate --seed
    ```

8. Jalankan server lokal untuk proyek:

    ```bash
    php artisan serve
    ```

    Proyek sekarang dapat diakses di `http://localhost:8000`.

## Teknologi yang Digunakan

-   **Laravel:** Framework PHP yang kuat dan intuitif, digunakan untuk mengembangkan backend aplikasi dan menyediakan routing, autentikasi, dan interaksi dengan database.
-   **Telegram Bot API:** Digunakan untuk menghubungkan aplikasi dengan platform Telegram, memungkinkan bot berinteraksi dengan pengguna melalui obrolan.
-   **Bootstrap Dan Tailwind CSS:** Digunakan untuk merancang tata letak responsif dan menarik untuk antarmuka pengguna.
-   **Database (MySQL):** Untuk menyimpan data pengguna, riwayat obrolan, dan informasi lainnya.

## Kontribusi
- Raihan Alkawsar
- Kak Sahirul (Aril)

Kami sangat menyambut kontribusi dari komunitas. Jika Anda ingin berkontribusi, Anda dapat membantu dengan memperbaiki bug, menambahkan fitur baru, atau meningkatkan dokumentasi.
© 2023 - Ict Center
