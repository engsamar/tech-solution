<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class CommonProblem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'image',
        'file'
    ];

    public function getFileAttribute($value)
    {
        if ($value != '') {
            $value = asset($value);
        }
        return $value;
    }
}