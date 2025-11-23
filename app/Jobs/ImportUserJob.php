<?php

namespace App\Jobs;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class ImportUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $filePath) {}

    public function handle()
    {
        // 1️⃣ Import users from Excel
        Excel::import(new UsersImport, storage_path('app/' . $this->filePath));

        // 2️⃣ Hash passwords asynchronously in chunks
        User::whereNotNull('password')
            ->chunk(50, function ($users) {
                foreach ($users as $user) {
                    if (!str_starts_with($user->password, '$2y$')) {
                        $user->password = Hash::make($user->password);
                        $user->save();
                    }
                }
            });
    }
}
