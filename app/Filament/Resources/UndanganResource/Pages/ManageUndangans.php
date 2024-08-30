<?php

namespace App\Filament\Resources\UndanganResource\Pages;

use App\Filament\Resources\UndanganResource;
use App\Imports\UndangansImport;
use App\Models\Undangan;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
// use Filament\Actions\Modal\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use illuminate\Support\Str;

class ManageUndangans extends ManageRecords
{
    protected static string $resource = UndanganResource::class;
    protected static bool $canCreateAnother = false;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Baru')->color('new')
            ->mutateFormDataUsing(function (array $data): array {
                if (!auth()->user()->isAdmin()) {
                    $data['user_id'] = auth()->id();
                }
                $data['phone'] = preg_replace("/[^0-9]/", "", $data['phone']);
                if (substr($data['phone'], 0, 1) != 0 ) {
                    if (substr($data['phone'], 0, 1) == 8) {
                        $data['phone'] = '0'.$data['phone'];
                    } elseif (substr($data['phone'], 0, 1) == 6) {
                        $data['phone'] = '0'.substr($data['phone'],2);
                    }
                }
                // dd($data['pembuka']);
                return $data;
            })
            ->successNotification(
                Notification::make()
                     ->success()
                     ->title('Berhasil Menambah Tamu')
                     ->body('Tamu Undangan Berhasil Ditambahkan.'),
             )->slideOver(),
//              ImportAction::make()
//              ->uniqueField('name')
//              ->handleBlankRows(true)
//              ->fields([
//                  ImportField::make('name')
//                      ->required()
//                      ->label('Nama'),
//                  ImportField::make('phone')
//                      ->required()
//                      ->label('No WA'),
//              ])
//              ->handleRecordCreation(function($row){
//                 $pembuka = "Kepada Yth.
// Bapak/Ibu/Saudara/i
// *".$row['name']."*

// Assalamualaikum Warahmatullahi Wabarakatuh.
// Salam sejahtera untuk kita semua.

// Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami:

// *Fatimah Tunnada, S.Kom. & Deny Setyawan Bayu Aji, S.Kom.*

// Detail undangan dapat diakses melalui tautan berikut:
// https://groovepublic.com/dzulhia-subhan?to=Deny+Setyawan+Bayu+Aji,+S.Kom

// Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir di acara pernikahan kami.

// Mohon maaf perihal undangan hanya di bagikan melalui pesan ini.
// Atas perhatiannya kami ucapkan terima kasih.

// Salam dan Hormat Kami,
// Wassalamualaikum Warahmatullahi Wabarakatuh.";
//                 $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//                 $charactersNumber = strlen($characters);
//                 $code = '';
//                 while (strlen($code) < 5) {
//                     $position = rand(0, $charactersNumber - 1);
//                     $character = $characters[$position];
//                     $code = $code.$character;
//                 }
//                 $code = $code.'-'.strtok($row['name'], " ");
//                 $slug = Str::slug($row['name']);
//                 if (strlen($row['phone']) == null) {
//                     // dd($row['phone']);
//                     $phone = $row['phone'];
//                 } else {
//                     # code...
//                     if (substr($row['phone'], 0, 1) == 0) {
//                         $phone = '+62'.substr($row['phone'],1);
//                     } elseif (substr($row['phone'], 0, 1) != 0 AND substr($row['phone'], 0, 1) != '+') {
//                         if (substr($row['phone'], 0, 1) == 8) {
//                             $phone = '+62'.$row['phone'];
//                         } elseif (substr($row['phone'], 0, 1) == 6) {
//                             $phone = '+'.$row['phone'];
//                         } else {
//                             $phone = $row['phone'];
//                         }
//                     } else {
//                         $phone = $row['phone'];
//                     }
//                 }
//                 $row['phone'] = $phone;
//                 $row['slug'] = $slug;
//                 $row['kode'] = $code;
//                 $row['pembuka'] = $pembuka;
//                 // dd(Undangan::create($row));

//                 return Undangan::create($row);
//             }),
        ];
    }

    public function getTitle(): string
    {
        return 'Tamu Undangan Digital';
    }

    public function getHeader(): ?View
    {
        $data =  Actions\CreateAction::make()->label('Tambah Baru')->color('new');

        return view('filament.custom.upload-file', ['data' => $data]);
    }

    public $file ='';
    public $buttonShow = false;
    public function import(){
        if ($this->file != '') {
            Excel::import(new UndangansImport, $this->file);
        }
        $this->file = null;
        $this->buttonShow = false;
        Notification::make()
        ->title('Import Data Sukses')
        ->success()
        ->send();
    }

    public function generate(){
        // dd('generating...');
        $cek = Undangan::count();
        // dd($cek);
        if ($cek > 0) {
            $user = User::find(auth()->id());
            $rows = Undangan::all();
            foreach ($rows as $row) {
                $row['pembuka'] = "Kepada Yth.
Bapak/Ibu/Saudara/i
*".$row['name']."*

Assalamualaikum Warahmatullahi Wabarakatuh.
Salam sejahtera untuk kita semua.

Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami:

*Fatimah Tunnada, S.Kom. & Deny Setyawan Bayu Aji, S.Kom.*

Detail undangan dapat diakses melalui tautan berikut:
".env('APP_URL')."/"."invitation/".$user['slug']."/".$row['slug']."

Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir di acara pernikahan kami.

Mohon maaf perihal undangan hanya di bagikan melalui pesan ini.
Atas perhatiannya kami ucapkan terima kasih.

Salam dan Hormat Kami,
Wassalamualaikum Warahmatullahi Wabarakatuh.";
                $row->save();
            }
            Notification::make()
            ->title('Generate Pesan Sukses')
            ->success()
            ->send();
        } else {
            Notification::make()
            ->title('Tidak Ada Data')
            ->danger()
            ->send();
        }

    }
}
