<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupsGroup
 */
class GroupsGroup extends Model
{
    protected $table = 'groups_groups';

    public $timestamps = false;

    protected $fillable = [
        'first_id',
        'last_id',
        'level',
        'parent_sid',
        'extra',
        'application'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Groups()
    {
        return $this->belongsTo('App\Models\Group');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Items()
    {
        return $this->belongsTo('App\Models\Item');
    }
}