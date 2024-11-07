<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetailsModel extends Model
{
    use HasFactory;
    public $table="transactiondetails";
    protected $fillable = ['id',
                            'TransactionHeaderID',
                            'ItemCode',
                            'REC_QTY',
                            'PO_QTY',
                            'POUserID ',
                            'RECUserID',
                            'ExcelFilename ',
                            'CreatedDate',
                            'LastUpdateDate',
                            'IsApproved',
                            'CreatedById',
                            'UpdatedById',
                            'ApprovedById',
                            'ReceivedById',
                            'updated_at',
                            'created_at',
                            'Remarks',
                            'ExpirationDate',
                            'ReceivingDate',
                            'isDelete',
                            'DeletedById',
                            'DeleteRemarks',
                            'isDuplicate',
                        ];
}
