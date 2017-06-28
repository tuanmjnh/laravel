<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LanguageKey
 */
class LanguageKey extends Model
{
    protected $table = 'language_key';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
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