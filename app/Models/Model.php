<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public $timestamps = true;

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }


    public function dateFormatted($filedDate = 'created_at', $showTimes = false)
    {
        $format = 'M d, Y';
        if ($showTimes) {
            $format = $format . ' @ h:i a';
        }

        return $this->$filedDate->format($format);
    }

    public function getImageAttribute($value)
    {
        if ($value != '') {
            $value = asset($value);
        } else {
            $value = asset('/no-pictures.png');
        }
        return $value;
    }
}
