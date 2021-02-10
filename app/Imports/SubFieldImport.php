<?php

namespace App\Imports;

use App\Models\SubField;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubFieldImport implements ToModel,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $sub_field = new SubField();
        $sub_field->fieldID = $row['field_id'];
        $sub_field->subFieldName = $row['sub_field_name'];
        $sub_field->translation = $row['translation'];
        $sub_field->save();
        return $sub_field;
    }
}
