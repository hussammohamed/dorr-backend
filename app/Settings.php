<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //
    protected $fillable = [
        'site_name','site_title_ar','site_title_en','full_domain','meta_keywords_ar','meta_description_ar',
        'meta_keywords_en','meta_description_en','email_no_reply','email_contact','copy_right_ar',
        'copy_right_en','website_status','multilingual','basic_language'
    ];
}
