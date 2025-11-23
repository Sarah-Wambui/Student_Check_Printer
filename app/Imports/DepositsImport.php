<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Deposit;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class DepositsImport implements ToModel, WithHeadingRow, WithChunkReading
{
        /**
     * Process rows in chunks
     */
    public function chunkSize(): int
    {
        return 100; // adjust chunk size if needed
    }

     public function batchSize(): int
    {
        return 100; // improves performance
    }

    /**
     * Convert Excel time to H:i:s
     */
    private function excelTimeToHMS($value)
    {
        if (!$value) return null;

        try {
            $date = ExcelDate::excelToDateTimeObject($value);
            return $date->format('H:i:s');
        } catch (\Exception $e) {
            return null;
        }
    }

        /**
     * Handle each row
     */

    public function model(array $row)
    {
        // Clean keys
        $row = collect($row)->mapWithKeys(fn ($v, $k) => [trim($k) => $v])->toArray();
        // dd($row);
        // Normalize name
        $name = trim($row['name'] ?? '');

        if (!$name) {
            return null; // skip empty rows
        }

        // Try to find user by their Name column
        $user = User::where('time_clock_name', $name)->first();

        // If not found → create automatically
        if (!$user) {
            $user = User::create([
                'employee_id'          => $row['employee_id'] ?? null,
                'username'             => $row['username'] ?? null,
                'time_clock_name'      => $name,
                'legal_first_name'     => $row['legal_first_name'] ?? null,
                'legal_last_name'      => $row['legal_last_name'] ?? null,
                'hebrew_yiddish_name'  => $row['hebrewyiddish_name'] ?? null,
                'email'                => $row['email'] ?? null,
                'password'             => isset($row['password']) ? Hash::make($row['password']) : Hash::make('sarah843'),
                'role'                 => $row['role'] ?? 'employee',
                'is_suspended'         => isset($row['is_suspended']) ? (bool)$row['is_suspended'] : false,
                'address'              => $row['address'] ?? null,
                'city'                 => $row['city'] ?? null,
                'state'                => $row['state'] ?? null,
                'zip'                  => $row['zip'] ?? null,
                'phone_home'           => $row['phone_home'] ?? null,
                'phone_cell'           => $row['phone_cell'] ?? null,
                'dob'                  => !empty($row['dob']) ? Carbon::instance(ExcelDate::excelToDateTimeObject($row['dob']))->format('Y-m-d') : null,
                'ssn'                  => $row['ssn'] ?? null,
                'leu_percent'          => $row['leu'] ?? null,
                'status_2025_26'       => $row['status_2025_26'] ?? null,
                'high_school'          => $row['high_school'] ?? null,
                'hs_city_state'        => $row['hs_citystate'] ?? null,
                'hs_grad_date'         => $row['hs_grad_date'] ?? null,
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
                'date_enrolled_amidei' => $row['date_enrolled_amidei'] ?? null,
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

        // Only set phone number if it is empty
        if (empty($user->phone_cell)) {
            $user->update([
                'phone_cell' => '1' . str_pad($user->id, 9, '0', STR_PAD_LEFT),
            ]);
        }


        // --- Convert Excel Date Correctly ---
        $formattedDate = null;
        if (!empty($row['date'])) {
            try {
                $carbonDate = \Carbon\Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date'])
                );
                $formattedDate = $carbonDate->format('Y-m-d');
            } catch (\Exception $e) {
                $formattedDate = null;
            }
        }

        // --- Convert Excel Time Values ---
        $amIn  = isset($row['am_in'])  ? gmdate("H:i:s", floatval($row['am_in'])  * 86400) : null;
        $amOut = isset($row['am_out']) ? gmdate("H:i:s", floatval($row['am_out']) * 86400) : null;
        $pmIn  = isset($row['pm_in'])  ? gmdate("H:i:s", floatval($row['pm_in'])  * 86400) : null;
        $pmOut = isset($row['pm_out']) ? gmdate("H:i:s", floatval($row['pm_out']) * 86400) : null;

        return new Deposit([
            'user_id' => $user->id,
            'Name'    => $name,
            'Date'    => $formattedDate,
            'AM_In'   => $amIn,
            'AM_Out'  => $amOut,
            'PM_In'   => $pmIn,
            'PM_Out'  => $pmOut,
            'Total'   => isset($row['total']) ? (float)$row['total'] : 0,
        ]);

    }
}
