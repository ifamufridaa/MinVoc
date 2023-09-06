<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifikasi extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'read_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsRead()
    {
        $this->read_at = now();
        $this->save();
    }

public function artis()
{
    return $this->belongsTo(Artis::class, 'user_id');
}
}
