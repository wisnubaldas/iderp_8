<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama
 * @property string $logo
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 */
class Brand extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'b_brand';

    /**
     * @var array
     */
    protected $fillable = ['nama', 'logo', 'url', 'created_at', 'updated_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'cjfi';

}
