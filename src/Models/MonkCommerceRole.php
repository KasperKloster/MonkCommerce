<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
use KasperKloster\MonkCommerce\Models\MonkCommerceUser;

class MonkCommerceRole extends Model
{
  protected $table = 'mc_roles';
  public $timestamps = false;

  /* Relationships */
  public function user()
  {
    return $this->hasMany(MonkCommerceUser::class);
  }
}
