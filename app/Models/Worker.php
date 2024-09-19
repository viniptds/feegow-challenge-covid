<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    const CPF_HASH_ALGORYTHM = 'AES-128-ECB';

    protected $fillable = ['fullname', 'birthdate', 'cpf', 'cpf_reduced', 'has_comorbidity'];

    public function getBirthdateAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
    
    // Only for report usage
    public function getFullCpfAttribute()
    {
        return self::decryptCPF($this->attributes['cpf']);
    }

    public function cpf() : Attribute
    {
        return Attribute::make(
            get: fn (string $value, array $attributes) => substr(self::decryptCPF($attributes['cpf']), 0, 3) . "********",
            set: fn (string $value) => self::encryptCPF($value),
        );
    }
    
    private static function encryptCPF($value)
    {
        return openssl_encrypt($value, Worker::CPF_HASH_ALGORYTHM, env('APP_KEY'));
    }

    private static function decryptCPF($value)
    {
        return openssl_decrypt($value, Worker::CPF_HASH_ALGORYTHM, env('APP_KEY'));
    }

    public function vaccines()
    {
        return $this->belongsToMany(Vaccine::class, 'worker_vaccines', 'worker_id', 'vaccine_id')->withPivot('applied_at')->orderByPivot('applied_at');
    }
}
