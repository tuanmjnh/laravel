<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 */
class Item extends Model
{
    protected $table = 'items';

    public $timestamps = true;

    protected $fillable = [
        'lang_code',
        'type',
        'app_key',
        'title',
        'description',
        'content',
        'images',
        'icon',
        'url',
        'first_price',
        'last_price',
        'total_sub_item',
        'total_view',
        'last_view',
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

    public function GroupsGroups()
    {
        return $this->hasMany('App\Models\GroupsGroup');
    }
}