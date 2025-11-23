<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\DepositsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\ImportDepositsJob;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DepositImportController extends Controller
{
    // public function importDeposits(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|file|mimes:xlsx,xls,csv', // allow CSV
    //     ]);

    //     $file = $request->file('file');

    //     // --- Convert Excel to CSV ---
    //     $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());

    //     $csvPath = storage_path('app/imports/' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.csv');

    //     $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Csv');
    //     $writer->save($csvPath);

    //     // --- Dispatch job with CSV path ---
    //     ImportDepositsJob::dispatch('imports/' . basename($csvPath));

    //     return redirect()->back()->with('success', 'Deposits import started. File will be processed.');
    // }

        public function importDeposits(Request $request) 
        { 
            $request->validate([ 'file' => 'required|file|mimes:xlsx,xls', ]); 
        // Save file to storage 
           $path = $request->file('file')->store('imports'); 
           // Dispatch job with file path 
           ImportDepositsJob::dispatch($path);
           
           return redirect()->route('admin.deposits')->with('success', 'Deposits import started. File will be processed.');
        } 
        

}

