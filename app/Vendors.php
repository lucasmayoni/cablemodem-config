<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendors extends Model
{
    //
    protected $table = 'docsis_update';


    /**
     * @param $fields
     * @param array $availableVendors
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($fields, array $availableVendors)
    {
       // dd($filtered->toArray());
        $data = $this->where(function(\Illuminate\Database\Eloquent\Builder $query) use ($fields) {
            $query->ofDescription($fields);
        })->get();
        dd($data->paginate(50));

    }

    /**
     * @param $query
     * @param array $fields
     * @return mixed
     */
    public function scopeOfDescription($query, array $fields)
    {
        if (isset($fields['vendor'])) {
            $query->where('vsi_vendor', 'like','%'.$fields['vendor'].'%');
        }
        return $query;
    }
}
