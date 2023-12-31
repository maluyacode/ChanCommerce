<?php

namespace App;

use Session;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {

        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($items, $id)
    {
       
        // dd($this->items);
        $storedItem = ['qty' => 0, 'price' => $items->sellprice, 'item' => $items];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        //$storedItem['qty'] += $item->qty;
        $storedItem['qty']++;

        $storedItem['price'] = $items->sellprice * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $items->sellprice;
    }

    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['sellprice'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['sellprice'];
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }
    public function removeItem($id)
    {
        //dd($this->items);
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
