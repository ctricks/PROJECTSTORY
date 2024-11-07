<?php
namespace App\Imports;

use App\Models\ReceivingItemModel;
use Maatwebsite\Excel\Concerns\ToModel;

class RECUploadImport implements ToModel
{
    private $SONumber;
    private $DR;
    private $details;
    private $current = 0;
    private $ReceivedByID;

    public function __construct($SONumber, $DR, $details,$ReceivedByID)
    {
        $this->SONumber = $SONumber;
        $this->DR = $DR;
        $this->details = $details;
        $this->ReceivedByID = $ReceivedByID;
    }

    public function model(array $row)
    {
        $this->current++;
        if ($this->current > 1) {
            $itemCode = $row[0]; // Assuming item code is in the first column

            // Check if $details is not null
            if (!empty($details)) {
                // Check if the item code exists in the $details array
                foreach ($this->details as $detail) {
                    if ($detail->Itemcode === $itemCode) {
                        // Item code matches, return a new model instance
                        $RECUploadModel = new ReceivingItemModel;
                        $RECUploadModel->ItemCode = $itemCode;
                        $RECUploadModel->recdate = $row[1];
                        $RECUploadModel->QTY_REC = $row[2];
                        $RECUploadModel->ExpirationDate = $row[3];
                        $RECUploadModel->DetailIDRef = $row[4];
                        $RECUploadModel->SONumber = $this->SONumber;
                        $RECUploadModel->DetailIDRef = $this->DR;
                        $RECUploadModel->ReceivedByID = $this->ReceivedByID;
                        $RECUploadModel->save();
                        return $RECUploadModel;
                    }
                }
            }

            // Item code not found in $details, return null
            return null;
        }
    }

}
