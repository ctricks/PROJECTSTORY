<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOUploadModel extends Model
{
    use HasFactory;

    public $table="transactiondetails";

    // protected $fillable = ['CATEGORY',  
    //                         'ITEMCODE',
    //                          'BRANCHID',
    //                          'QTY',
    //                          'PKEY',
    //                          'UploadedByID',
    //                          'EXCELFILENAME'
    //                         ];
        protected $fillable = ['ExcelFilename',
        'SO_Number',
            'ItemCode',
            'PO_QTY',
        ];
}
