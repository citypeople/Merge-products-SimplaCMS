<?
/*
name: Merge-products-SimplaCMS
����������� ������� � SimplaCMS.
SimplaCMS.

� ������ ������� ���� ����� ��������, ������ �������� ������� �� ����, � ������ �� ��� �����������, �������� ������ � �����, �������, ����, �� �� ���� ��� ���� �����.
� ������� ����� "���������" � ������� 37, 38, 39.
 
��� ��� ��������� ��������� ����� ��� ������� ��������� � ������ ������������.
� ����� ������ �������� ����������� ������ ������� ���������� ���������� � ���� ���� ������.
� ����� ��� ���������� ������ ���������, � �� �������� ���� ����� � ���������� ���������.

����� ���������� ��� ��������� ������ ��� � ����� ���������������.
����� ����������� �������� ������ ������ ��������� �����, ��� ��������� ��������� � ��� ��������, � ��������� ������ ������������, ������, ���� � �������.

��� ����������� ������� �������� ������ ���� ����������, �� ������� ���������� ������.

hi@citypeople.ru
citypeople.ru

������ 85. �������� ����:
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