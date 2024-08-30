<?php

namespace App\Filament\Imports;

use App\Models\Undangan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use illuminate\Support\Str;

class UndanganImporter extends Importer
{
    protected static ?string $model = Undangan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Nama')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('phones')
                ->label('No WA')
                ->requiredMapping()
                // ->guesses(['No', 'WA', 'no wa'])
        ];
    }

    public function resolveRecord(): ?Undangan
    {
        $pembuka = "Kepada Yth.
Bapak/Ibu/Saudara/i
*".$this->data['name']."*

Assalamualaikum Warahmatullahi Wabarakatuh.
Salam sejahtera untuk kita semua.

Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami:

*Fatimah Tunnada, S.Kom. & Deny Setyawan Bayu Aji, S.Kom.*

Detail undangan dapat diakses melalui tautan berikut:
https://groovepublic.com/dzulhia-subhan?to=Deny+Setyawan+Bayu+Aji,+S.Kom

Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir di acara pernikahan kami.

Mohon maaf perihal undangan hanya di bagikan melalui pesan ini.
Atas perhatiannya kami ucapkan terima kasih.

Salam dan Hormat Kami,
Wassalamualaikum Warahmatullahi Wabarakatuh.";
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);

        $code = '';

        while (strlen($code) < 5) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        $code = $code.'-'.strtok($this->data['name'], " ");
        $slug = Str::slug($this->data['name']);
        if (strlen($this->data['phone']) < 2) {
            // dd($this->data['phone']);
            $phone = $this->data['phone'];
        } else {
            # code...
            if (substr($this->data['phone'], 1, 1) == 0) {
                $phone = '+62'.substr($this->data['phone'],2);
            } elseif (substr($this->data['phone'], 1, 1) != 0 AND substr($this->data['phone'], 1, 1) != '+') {
                if (substr($this->data['phone'], 2, 1) == 8) {
                    $phone = '+62'.$this->data['phone'];
                } elseif (substr($this->data['phone'], 2, 1) == 6) {
                    $phone = '+'.$this->data['phone'];
                }
            } else {
                $phone = substr($this->data['phone'],1);
            }
        }
        // dd($this->data['name']);
        return Undangan::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            'slug' => $slug,
            'kode' => $code,
            'phone' => $phone,
            'pembuka' => $pembuka
        ]);

        // return new Undangan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Import Tamu Undangan Selesai dan ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' Data Telah Di Import.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' Gagal Di Import.';
        }

        return $body;
    }
}
