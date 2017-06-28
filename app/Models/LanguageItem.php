<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LanguageItem
 */
class LanguageItem extends Model
{
    protected $table = 'language_items';

    public $timestamps = false;

    protected $fillable = [
        'lid',
        'lkid',
        'title',
        'desc',
        'extra',
        'application'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Languages()
    {
        return $this->belongsTo('App\Models\Language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function LanguageKeys()
    {
        return $this->belongsTo('App\Models\LanguageKey');
    }
}