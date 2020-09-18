<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'detail','ativotipobenspatrimoniais','excluidotipobenspatrimoniais',
    ];

    public static function laratablesCustomAction($tipoBensPatrimoniaisModel)
    {
        return view('products.action', compact('tipoBensPatrimoniaisModel'))->render();
    }
}
