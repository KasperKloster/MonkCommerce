<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
use KasperKloster\MonkCommerce\Models\MonkCommerceRole;

class MonkCommerceUser extends Model
{
    protected $table = 'users';
    protected $fillable = [
      'name', 'email', 'password', 'role_id',
    ];
    /* Relationships */
    public function role()
    {
      return $this->belongsTo(MonkCommerceRole::class);
    }
}
