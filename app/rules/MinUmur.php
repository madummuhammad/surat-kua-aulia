<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class MinUmur implements Rule
{
    protected $umurMinimal;

    public function __construct($umurMinimal)
    {
        $this->umurMinimal = $umurMinimal;
    }

    public function passes($attribute, $value)
    {
        // Validasi apakah tanggal lahir setidaknya $umurMinimal tahun yang lalu
        return Carbon::parse($value)->addYears($this->umurMinimal)->isPast();
    }

    public function message()
    {
        return ":attribute harus berusia minimal {$this->umurMinimal} tahun.";
    }
}
