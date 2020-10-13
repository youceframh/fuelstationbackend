<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companies_files extends Model
{
    protected $fillable = [
        'name','type','content','size','company_id'
    ];
}
