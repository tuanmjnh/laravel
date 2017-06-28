<?php namespace App\Libraries\Repositories;

use App\Models\setting;
use Illuminate\Support\Facades\Schema;
use App\Libraries\AAI\RepositoryAbstract;
use App\Libraries\AAI\RepositoryInterface;

class settingRepository extends RepositoryAbstract implements RepositoryInterface
{
    protected $modelClassName = 'App\Models\setting';
	public function search($input)
    {
        $query = setting::query();

        $columns = Schema::getColumnListing('settings');
        $attributes = array();

        foreach($columns as $attribute){
            if(isset($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] =  $input[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        return [$query->get(), $attributes];

    }


}