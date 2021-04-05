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
        $field_1 = DB::table('field')->where('accTypeID',1)->get();
        $field_2 = DB::table('field')->where('accTypeID',2)->get();
        $field_id_1 = null;
        $field_id_2 = null;





        foreach ($field_1 as $fi)
        {
            if($fi->fieldName == $field_name)
            {
                $field_id_1 = $fi->fieldID;;
                break;
            }
        }
        foreach ($field_2 as $f)
        {
            if($f->fieldName == $field_name)
            {
                $field_id_2 = $f->fieldID;;
                break;
            }
        }



        //echo $field->fieldID.'  '.$row['sub_field_name'].'       '.$row['translation'].'<br>';
        if($field_id_1 == null)
        {
            $field_id_1 = $this->insert_field(1,$field_name);
        }
        $sub_field_1 = $this->insert_sub_field($field_id_1,$row['sub_field_name'],$row['translation']);


        if($field_id_2 == null)
        {
            $field_id_2 = $this->insert_field(2,$field_name);
        }
        $sub_field_2 = $this->insert_sub_field($field_id_2,$row['sub_field_name'],$row['translation']);
        return ;
    }


    public function insert_field($acc_type_id,$field_name)
    {
        $field = new Field();
        $field->accTypeID = $acc_type_id;
        $field->fieldName = $field_name;
        $field->save();
        $field_id = $field->fieldID;

        return $field_id;
    }


    public function insert_sub_field($field_id,$sub_field_name,$translation)
    {
        $sub_field = new SubField();
        $sub_field->fieldID = $field_id;
        $sub_field->subFieldName = $sub_field_name;
        $sub_field->translation = $translation;
        $sub_field->save();
        return $sub_field;
    }
}
