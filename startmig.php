<?php
ini_set("soap.wsdl_cache_enabled", "0");
$client = new SoapClient('http://XXXXXXXXXXXXX YOUR MAGENTO 1 WEBISTEXXXXXXXXXXXXXXXX/api/v2_soap?wsdl=1');
// If somestuff requires api authentification,
// then get a session token
$session = $client->login('XXXX', 'XXXXXXXXXX');
$result = $client->catalogCategoryAssignedProducts($session, '346');//346 Category ID 
$result = json_decode(json_encode($result), true);

foreach ($result as &$product) {
   if (isset($product['product_id'])) {
	   //Get Product Data From Magento 1 
      $product['options'] =json_decode(json_encode( $client->catalogProductInfo($session, $product['product_id'])), true);
	  $product['img'] = json_decode(json_encode( $client->catalogProductAttributeMediaList($session, $product['product_id'])), true);
	  //SET Product Data From Magento 2
	  include('insert.php');
	  include('insertimg.php');
   }
  // break;
}
//print_r($result);

// If you don't need the session anymore
$client->endSession($session);