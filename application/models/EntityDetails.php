<?php 

/**
 * this will get different entity details that can be use inside api
 */
class EntityDetails extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getCategoryDetails($id)
	{
		loadClass($this->load,'category');
		$category = new Category(array('ID'=>$id));
		if (!$category->load()) {
			return false;
		}
		$all = isset($_GET['all']) && $_GET['all']?true:false;
		$result= $category->toArray();
		if (!$all) {
			return $result;
		}
		$customer = getCustomer();
		loadClass($this->load,'product');
		$product = new Product();
		$query="select * from product where category_id=$id";
		$products = $product->getProductDetails($query,$customer);
		$result['products']=$products;
		return $result;
	}
}
 ?>