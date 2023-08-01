<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Supplier;
use App\Models\Category;

class ItemsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Item([
            'item_name' => $row['name'],
            'sellprice' => $row['sellprice'],
            'description' => $row['description'],
            'img_path' => $row['images'],
            // 'sup_id' => $row['supplier'],
            // 'cat_id' => $row['category'],
            'sup_id'    => Supplier::where('sup_name', trim($row['supplier']))->value('id'),
            'cat_id'    => Category::where('cat_name', trim($row['category']))->value('id'),
        ]);
    }
}
