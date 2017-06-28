<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 */
class Language extends AbstractModel
{
    protected $table = 'language';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'native_name',
        'lang_code',
        'post_code',
        'country_code',
        'currency',
        'images',
        'icon',
        'description',
        'created_by',
        'updated_by',
        'orders',
        'flag',
        'application'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function LanguageItems()
    {
        return $this->hasMany('App\Models\LanguageItem');
    }
}