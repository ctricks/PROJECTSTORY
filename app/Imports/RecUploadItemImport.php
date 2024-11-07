<?php

namespace App\Imports;

use App\Models\ReceivingItemModel;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RecUploadItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $current= 0;
    public $filename;
    
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function model(array $row)
    {
        
        // $this->current++;
        // if ($this->current > 1) {
        //     return new ReceivingItemModel([
        //         'ItemCode' => $row[0],
        //         'recdate' => $row[1],
        //         'QTY_REC' => $row[2],
        //         'ExpirationDate' => $row[3],
        //         'DRNo' => $row[4],
        //         'SONumber' => $row[5],
        //     ]);
        // }
         // Extract the date value from the 'recdate' column
        

        $this->current++;
        if($this->current > 1)
        {
            $ReceivingItemModel = new ReceivingItemModel;

            // Extract the date values
            $recdateValue = $row['1'];
            $expirationDateValue = $row['3'];
            
            // Convert the Excel date values to PHP timestamps
                $recdateTimestamp = Date::excelToTimestamp($recdateValue);
                $expirationDateTimestamp = Date::excelToTimestamp($expirationDateValue);
                
                // Format the timestamps as desired (e.g., 'Y-m-d')
                $formattedRecdate = date('Y-m-d', $recdateTimestamp);
                $formattedExpirationDate = date('Y-m-d', $expirationDateTimestamp);

                // Check for duplicates based on SONUMBER and itemcode
                $existingItem = ReceivingItemModel::where('SONumber', $row[5])
                ->where('ItemCode', $row[0])
                ->where('ExpirationDate', $formattedExpirationDate)
                ->first();

                if ($existingItem) {
                    // Update existing item's QTY_REC
                    $existingItem->QTY_REC += $row[2];
                    $existingItem->save();
                } else {

                $ReceivingItemModel->ItemCode = $row[0];
                $ReceivingItemModel->recdate = $formattedRecdate;
                $ReceivingItemModel->QTY_REC = $row[2];
                $ReceivingItemModel->ExpirationDate = $formattedExpirationDate;
                $ReceivingItemModel->DRNo = $row[4];
                $ReceivingItemModel->SONumber = $row[5];
                $ReceivingItemModel->Filename = $this->filename;

                $ReceivingItemModel->ReceivedByID = 1;

                $ReceivingItemModel->save();
                }

        }
    }
}
