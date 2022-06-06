<?php

namespace App\Models;

use App\Models\User;
use App\Models\Admin;
use App\Models\Support;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReplySupport extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'reply_support'; // especifica o nome da tabela que esse Model representa no banco de dados

    protected $fillable = [
        'user_id', 'admin_id', 'support_id', 'description'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function support() {
        return $this->belongsTo(Support::class);
    }
}
