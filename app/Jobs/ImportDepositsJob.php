<?php

namespace App\Jobs;

use App\Imports\DepositsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportDepositsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $filePath) {}

    public function handle()
    {
        Excel::import(new DepositsImport, storage_path('app/' . $this->filePath));
    }
}
