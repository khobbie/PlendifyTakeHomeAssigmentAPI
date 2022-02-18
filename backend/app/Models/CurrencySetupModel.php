<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencySetupModel extends Model
{
    use HasFactory;


    /**
     * Model table name.
     *
     * @var string
     */
    protected $table = 'currencies';


    /**
     * Model table name primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}