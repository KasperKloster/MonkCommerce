<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;

class MonkCommerceStaticPages extends Model
{
    protected $table = 'mc_static_pages';

    //  mass-assignable
    protected $fillable = [
      'name',
      'slug',
      'description',
      'show_in_menu'
    ];
}
