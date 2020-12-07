<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['code'];

    public static function generateDeviceId(): string
    {
        $data = [
            'code' => Str::uuid()
        ];

        $transaction = new self();
        $transaction->fill($data)
            ->save();

        return $data['code'];
    }
}
