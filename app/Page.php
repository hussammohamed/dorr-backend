<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $fillable = [
        'title_ar','title_en','full_content_ar','full_content_en','short_content_ar','short_content_en',
        'order','active','deleted'
    ];
}
