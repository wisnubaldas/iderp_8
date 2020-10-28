<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserModule extends Pivot
{
    use HasFactory;
    protected $table = 'user_module';
    public $incrementing = true;
}
