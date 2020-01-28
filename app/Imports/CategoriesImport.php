<?php

namespace App\Imports;

use App\Categories;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoriesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $categories = new Categories();
        $categories->name = $row[0];
        $categories->save();

        for ($i = 1; $i < count($row); $i++) {
            if ($row[$i]) {
                $parentCategories = new Categories();
                $parentCategories->parent_id = $categories->id;
                $parentCategories->name = $row[$i];
                $parentCategories->save();
            }
        }
    }
}
