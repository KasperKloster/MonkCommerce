<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
use KasperKloster\MonkCommerce\Models\MonkCommerceRole;

class MonkCommereUser extends Model
{
    //
    protected $table = 'users';

    public function roles()
    {
        return $this->belongsToMany(MonkCommerceRole::class, 'mc_role_user', 'role_id', 'user_id');
    }
}
