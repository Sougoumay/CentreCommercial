<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class UsersExport implements FromCollection, Responsable, WithStrictNullComparison
{
    use Exportable;

    private $fileName = "users.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
        /*return new Collection([
            ['Hamid','elidjaihamid@gmail.com'],
            ['Ramat','walharouna@gmail.com'],
            ['Saad','hamiry@gmail.com']
        ]);*/
    }
}
