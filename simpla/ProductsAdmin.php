<?
/*
name: Merge-products-SimplaCMS
Объединение товаров в SimplaCMS.
SimplaCMS.

У многих наверно была такая проблема, делаем выгрузку товаров на сайт, и многие из них повторяются, различие только в цвете, размере, весе, но по сути это один товар.
К примеру носки "Бумеранги" и размеры 37, 38, 39.
 
Так вот небольшое упрощение жизни для контент менеджера и просто разработчика.
В общем списке выделяем необходимые товары которые необходимо объединить и жмем одну кнопку.
В итоге все выделенные товары удаляются, и мы получаем один товар с множеством вариантов.

Можно объединять как одиночные товары так и ранее сгруппированные.
После объединение остается только первый выбранный товар, все остальные переходят в его варианты, с указанием своего наименования, артику, цены и остатка.

При объединении товаров остается только одна фотография, от первого выбранного товара.

hi@citypeople.ru
citypeople.ru

Строка 85. Добавить блок:
*/
case 'combine':
{
    $combine_id = $ids[0];
    
    $sub_variants = $this->variants->get_variants(array('product_id'=>$ids));


    foreach ($sub_variants as $variant) 
    {    
        $native_product = $this->products->get_product((int)$variant->product_id);
        
        $variant->product_id = $combine_id;
        
        if (empty($variant->name)) $variant->name = $native_product->name;
        unset($variant->infinity);


        $this->variants->update_variant($variant->id, $variant);
        if (is_object($native_product) && ($native_product->id != $combine_id)) 
        {   $products_to_delete[]  = $native_product;
            
        }
    }
    foreach ($products_to_delete as $p) {
        $this->products->delete_product((int)$p->id);}
    
    break;
}
?>