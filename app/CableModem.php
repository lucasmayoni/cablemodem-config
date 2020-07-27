<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CableModem extends Model
{
    //
    protected $table = 'docsis_update';


    /**
     * @param $fields
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($fields)
    {
        $models = $this->arrayModels();
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

    /**
     * @return array
     */
    private function arrayModels()
    {
        $file = storage_path().'/models.json';
        $data = json_decode(file_get_contents($file), true);
        return array_unique(array_column($data['models'],'name'));
    }

}
