<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CableModem extends Model
{
    //
    protected $table = 'docsis_update';

    protected $fillable = [
        'vsi_model',
        'vsi_vendor'
    ];

    /**
     * @param $fields
     * @param array $models
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($fields, array $models)
    {
        return $this->select('*')
            ->where(function(Builder $query) use ($models){
                 $query->select('*')
                     ->whereNotIn('vsi_model',$models);
            })
            ->orderBy('vsi_model')
            ->paginate(20);
    }

    /**
     * @param $query
     * @param array $fields
     * @return mixed
     */
    public function scopeOfVendor($query, array $fields)
    {
        if (isset($fields['vendor'])) {
            $query->where('vsi_vendor', 'like','%'.$fields['vendor'].'%');
        }
        return $query;
    }



}
