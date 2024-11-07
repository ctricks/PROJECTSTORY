<?php

namespace App\Imports;

use App\Models\SOUploadModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SOImport implements ToCollection, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
  
        private $current= 0;
        public $filename;
    
        /** 
        * @param Collection $collection
        */
    
        public function __construct($filename)
        {
            $this->filename = $filename;
        }
    
        public function collection(Collection $collection)
        {
           // dd($collection);
        }

        public function model(array $row)
        {
            $this->current++;
            if($this->current > 1)
            {

                $SOUploadModel = new SOUploadModel;

                    $SOUploadModel->ExcelFilename = $this->filename;
                    $SOUploadModel->TransactionHeaderID = $this->transactNo;
                    $SOUploadModel->ItemCode = $row[0];
                    $SOUploadModel->PO_QTY = $row[1];
                    
                $SOUploadModel->save();

            }
        }
}

