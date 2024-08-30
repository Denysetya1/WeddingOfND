<?php

namespace App\Imports;

use App\Models\Undangan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;

class UndangansImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row)
        {
            $row['no_wa'] = preg_replace("/[^0-9]/", "", $row['no_wa']);
            if (substr($row['no_wa'], 0, 1) != 0) {
                if (substr($row['no_wa'], 0, 1) == 8) {
                    $phone = '0'.$row['no_wa'];
                } elseif (substr($row['no_wa'], 0, 1) == 6) {
                    $phone = '0'.substr($row['no_wa'],2);;
                }
            } else {
                $phone = $row['no_wa'];
            }
            $id = auth()->id();
            $namacheck = Undangan::where([['user_id', $id],['name', $row['nama']]])->first();
            // if($row['no_wa'] != null) {
            //     $phonecheck = Undangan::where([['user_id', $id],['phone', $phone]])->first();
            // }
            if ($namacheck) {
                if($row['no_wa'] != null){
                    if ($namacheck['phone'] != $phone) {
                        $namacheck['phone'] = $phone;
                        $namacheck->save();
                    }
                }
            }
            elseif ($row['no_wa'] != null) {
                // if ($phonecheck) {
                //     if ($phonecheck['name'] != $row['nama']) {
                //         $phonecheck['name'] = $row['nama'];
                //         $phonecheck->save();
                //     }
                // }
                // else {
                    $slug = Str::slug($row['nama']);

                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersNumber = strlen($characters);

                    $code = '';

                    while (strlen($code) < 6) {
                        $position = rand(0, $charactersNumber - 1);
                        $character = $characters[$position];
                        $code = $code.$character;
                    }
                    if (strlen($row['no_wa']) == null) {
                        // dd($row['phone']);
                        $phone = $row['no_wa'];
                    } else {
                        if (substr($row['no_wa'], 0, 1) != 0) {
                            if (substr($row['no_wa'], 0, 1) == 8) {
                                $phone = '0'.$row['no_wa'];
                            } elseif (substr($row['no_wa'], 0, 1) == 6) {
                                $phone = '0'.substr($row['no_wa'],2);;
                            }
                        } else {
                            $phone = $row['no_wa'];
                        }
                    }
                    $code = $code.'-'.strtok($row['nama'], " ");

                    $data = Undangan::create([
                        'user_id' => $id,
                        'name'  => $row['nama'],
                        'slug'  => $slug,
                        'kode'  => $code,
                        'phone' => $phone
                    ]);
                // }
            }
            // dd('cek');
            // dd($data);
        }
    }
}
