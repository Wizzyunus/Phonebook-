<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Address extends Model
{
    use HasFactory, SoftDeletes;

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addresses__';
    protected $primaryKey = 'uuid';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'uuid' => 'uuid',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'laravel_through_key',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'place_name',
        'place_status',
        'address_number',
        'address_street',
        'address_postcode',
        'address_city',
        'address_lat',
        'address_lon',
        'details_openinghours',
        'details_phone',
        'details_website',
        'details_wikidata',
        'description',
        'category_uuid',
        'country_uuid',
        'osm_id',
        'osm_place_id',
        'gmap_pluscode',
    ];

    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * Get the subcategory for a specific place.
     */
    public function inSubcategory()
    {
        return $this->belongsTo(
            'App\Models\Subcategory',
            'subcategory_slug',
            'slug'
        );
    }

}
