<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemsSub
 */
class ItemsSub extends Model
{
    protected $table = 'items_sub';

    public $timestamps = true;

    protected $fillable = [
        'iid',
        'lang_code',
        'app_key',
        'title',
        'description',
        'content',
        'images',
        'icon',
        'email',
        'url',
        'created_by',
        'updated_by',
        'end_at',
        'orders',
        'flag',
        'extra',
        'seo_link_url',
        'seo_link_search',
        'seo_keyword',
        'seo_desc',
        'seo_title',
        'seo_link',
        'seo_lang',
        'seo_extra',
        'seo_params',
        'application'
    ];

    protected $guarded = [];

        
}