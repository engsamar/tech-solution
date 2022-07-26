<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Problem extends Model
{
    use HasFactory;
    protected $fillable =['user_id', 'title', 'description',
    'category_id', 'tags', 'status', 'important','problem_number'];

    protected $appends =['tags_array'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getTagsArrayAttribute()
    {
        return $this->tags != null ? explode(',', $this->tags): [];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusSpanAttribute()
    {
        $value = '';
        if ($this->status == 0) {
            $value = "<span class='badge badge-pill badge-warning'> قيد الإنتظار</span>";
        } elseif ($this->status == 1) {
            $value = "<span class='badge badge-pill badge-success'>منتهية</span>";
        } elseif ($this->status == 2) {
            $value = "<span class='badge badge-pill badge-danger'>ملغية</span>";
        }

        return $value;
    }
}