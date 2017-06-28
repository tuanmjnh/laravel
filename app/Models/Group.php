<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 */
class Group extends Model
{
    protected $table = 'groups';

    public $timestamps = true;

    protected $fillable = [
        'lang_code',
        'type',
        'parent_id',
        'level',
        'parent_sid',
        'title',
        'description',
        'content',
        'images',
        'icon',
        'total_item',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function GroupsGroups()
    {
        return $this->hasMany('App\Models\GroupsGroup');
    }
}