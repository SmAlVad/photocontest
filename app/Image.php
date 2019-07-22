<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['description', 'like', 'is_active'];

    /**
     * Участник фотоконкурса
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * Фотоконкурс
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photocontest()
    {
        return $this->belongsTo(Photocontest::class);
    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::create($value)->format('d.m');
    }

    /**
     * Генерирует рандомную строку
     *
     * @param $length int
     * @return string
     */
    public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Возвращает имя файла без расширения.
     * Наличие расширения не проверяется
     *
     * @param $str string
     * @return string
     */
    public function getNameWithoutExt($str)
    {
        $tmpArr = explode('.', $str);
        $result = $tmpArr[0];

        return $result;
    }
}
