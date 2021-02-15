<?php

namespace App\Imports;

use App\Models\Field;
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

        $field_name = $row['field_name'];
        $field = DB::table('field')->get();
        $field_id = null;
        foreach ($field as $f)
        {
            if($f->fieldName == $field_name)
            {
                $field_id = $f->fieldID;;
                break;
            }
        }


        //echo $field->fieldID.'  '.$row['sub_field_name'].'       '.$row['translation'].'<br>';
        if($field_id == null)
        {
            $field = new Field();
            $field->accTypeID = 4;
            $field->fieldName = $field_name;
            $field->save();
            $field_id = $field->fieldID;
        }
        $sub_field = new SubField();
        $sub_field->fieldID = $field_id;
        $sub_field->subFieldName = $row['sub_field_name'];
        $sub_field->translation = $row['translation'];
        $sub_field->save();
        return $sub_field;



    }
}
