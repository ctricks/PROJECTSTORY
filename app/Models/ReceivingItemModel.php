<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivingItemModel extends Model
{
    use HasFactory;
    public $table="receivingitem";
    protected $fillable = ['id',
                            'DetailIDRef',
                            'QTY_REC',
                            'ExpirationDate',
                            'recdate',
                            'ReceivedByID',
                            'SONumber',
                            'ItemCode ',
                            'DRNo',
                            'Filename'
                        ];
}
