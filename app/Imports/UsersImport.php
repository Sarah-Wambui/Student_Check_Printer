<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class UsersImport implements ToModel, WithHeadingRow, WithChunkReading
{
            /**
     * Process rows in chunks
     */
    public function chunkSize(): int
    {
        return 50; // adjust chunk size if needed
    }

     public function batchSize(): int
    {
        return 50; // improves performance
    }


        /**
     * Safely convert Excel dates to Y-m-d or null
     */
    private function parseExcelDate($value)
    {
        if ($value && is_numeric($value)) {
            return Carbon::instance(ExcelDate::excelToDateTimeObject($value))->format('Y-m-d');
        }

        return null;
    }

        /**
     * Handle each row
     */
    public function model(array $row)
    {
        $row = collect($row)->mapWithKeys(fn($v, $k) => [trim($k) => $v])->toArray();
        // dd($row);
        return new User([
            'employee_id'          => $row['employee_id'] ?? null,
            'username'             => $row['username'] ?? null,
            'time_clock_name'      => $row['time_clock_name'] ?? null,
            'legal_first_name'     => $row['legal_first_name'] ?? null,
            'legal_last_name'      => $row['legal_last_name'] ?? null,
            'hebrew_yiddish_name'  => $row['hebrewyiddish_name'] ?? null,
            'email'                => $row['email'] ?? null,
            'password'             => $row['password'] ?? 'Temporary123!',
            'role'                 => $row['role'] ?? 'employee',
            'is_suspended'         => isset($row['is_suspended']) ? (bool)$row['is_suspended'] : false,
            'address'              => $row['address'] ?? null,
            'city'                 => $row['city'] ?? null,
            'state'                => $row['state'] ?? null,
            'zip'                  => $row['zip'] ?? null,
            'phone_home'           => $row['phone_home'] ?? null,
            'phone_cell'           => $row['phone_cell'] ?? null,
            'dob'                  => $this->parseExcelDate($row['dob'] ?? null),
            'ssn'                  => $row['ssn'] ?? null,
            'leu_percent'          => $row['leu'] ?? null,
            'status_2025_26'       => $row['status_2025_26'] ?? null,
            'high_school'          => $row['high_school'] ?? null,
            'hs_city_state'        => $row['hs_citystate'] ?? null,
            'hs_grad_date'         => $this->parseExcelDate($row['hs_grad_date'] ?? null),
            'diploma_attached'     => $row['diploma_attached'] ?? null,
            'prev_bm1_name'        => $row['prev_bm_1_name'] ?? null,
            'prev_bm1_city_state'  => $row['prev_bm_1_citystate'] ?? null,
            'prev_bm1_dates'       => $row['prev_bm_1_dates'] ?? null,
            'prev_bm1_transcript'  => $row['prev_bm_1_transcript'] ?? null,
            'prev_bm2_name'        => $row['prev_bm_2_name'] ?? null,
            'prev_bm2_city_state'  => $row['prev_bm_2_citystate'] ?? null,
            'prev_bm2_dates'       => $row['prev_bm_2_dates'] ?? null,
            'prev_bm2_transcript'  => $row['prev_bm_2_transcript'] ?? null,
            'other_yeshivas'       => $row['other_yeshivas'] ?? null,
            'date_enrolled_amidei' => $this->parseExcelDate($row['date_enrolled_amidei'] ?? null),
            'level_admitted'       => $row['level_admitted'] ?? null,
            'fathers_name'         => $row['fathers_name'] ?? null,
            'father_in_law_name'   => $row['father_in_law_name'] ?? null,
            'fil_address'          => $row['f_i_l_address'] ?? null,
            'fil_phone'            => $row['f_i_l_phone'] ?? null,
            'chabira_farmitug'     => $row['chabira_farmitug'] ?? null,
            'chabira_nuchmitug'    => $row['chabira_nuchmitug'] ?? null,
            'location_kollel'      => $row['location_kollel'] ?? null,
            'notes'                => $row['notes'] ?? null,
        ]);

    }

}
