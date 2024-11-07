<?php

namespace App\Imports;

use App\Models\TransactionDetailsModel;
use Maatwebsite\Excel\Concerns\ToModel;

class SOUploadImport implements ToModel
{
    /**
     * 
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $transactionHeaderSO_Number;
    private $current= 0;
    public $filename;
    

    public function __construct($SO_Number,$filename)
    {
        $this->SO_Number = $SO_Number;
        $this->filename = $filename;
    }
   
    
    public function model(array $row)
    {

        $this->current++;
        // if($this->current > 1)
        // {

        //     $SOUploadModel = new TransactionDetailsModel;
          
        //         $SOUploadModel->SO_Number = $this->SO_Number;
              
        //         $SOUploadModel->ItemCode = $row[0];
        //         $SOUploadModel->PO_QTY = $row[1];
                
        //     $SOUploadModel->save();

        // }

        if ($this->current > 1) {
            
$itemcol = 2;
$qtycol = 6;            
             
if(count($row) == 4)
{
    $itemcol = 0;
    $qtycol = 3;            
}

$itemCode = $row[$itemcol];
    $qty = $row[$qtycol]; 


                 // Set receivingDate to the current date
                 $receivingDate = now();

                 // Check if the item code and receiving date are valid
                 if (empty($itemCode) || empty($qty)) {
                    // Handle invalid data (e.g., log an error or return null)
                    return null;
                }                      
            $existingRecord = TransactionDetailsModel::find($itemCode);
            // Check if the item code already exists
                if (isset($itemCode) && $existingRecord != null) {
                // If it exists, update the existing record's PO_QTY                                
                $existingRecord->PO_QTY += $row[$qtycol];
                $existingRecord->save();
                }                
             else {
                // If it doesn't exist, create a new record
                $SOUploadModel = new TransactionDetailsModel;
                $SOUploadModel->SO_Number = $this->SO_Number;
                $SOUploadModel->ItemCode = $itemCode;
                $SOUploadModel->PO_QTY = $row[$qtycol];
                    $SOUploadModel->ExcelFilename = $this->filename;
                    
                $SOUploadModel->save();

                // Store the item code and its corresponding record ID
                $this->itemCodeMap[$itemCode] = $SOUploadModel->id;
                }            
        }
    }
}
