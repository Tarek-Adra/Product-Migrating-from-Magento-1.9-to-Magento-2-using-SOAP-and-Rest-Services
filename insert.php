<?php
$curl = curl_init();
$URL = "http://XXXXXXXXXXXX MAGENTO 2 XXXXXXXX";
 //print_r( $product); exit;
$data = array(
    "product"=> array(
        "sku"=> $product['options']['sku'],
        "name"=> $product['options']['name'],
        "attribute_set_id"=> $product['options']['set'],
        "price"=> $product['options']['price'],
        "status"=> 1,
        "visibility"=> 4,
        "type_id"=> $product['options']['type_id'],
		 
	 
		"weight"=>$product['options']['weight'],
	  
	 
        "extension_attributes"=> array(
            "stock_item"=> array(
                "manage_stock"=> 1,
                "is_in_stock"=> 1,
                "qty"=> $product['options']['qty'] 
            )
          
            
        ),
           "custom_attributes"=> array(array(
            "attribute_code"=> "quantity_and_stock_status",
            "value"=> array(
                "qty"=> $product['options']['qty'],
                "is_in_stock"=> 1
            )
        ), array(
            "attribute_code"=> "is_virtual",
            "value"=> 1
        ), array(
            "attribute_code"=> "description",
            "value"=> $product['options']['description']
        ), array(
            "attribute_code"=> "short_description",
            "value"=> $product['options']['short_description'],
        )/*, array(
            "attribute_code"=> "url_key",
            "value"=> $product['options']['url_key'],
        ), array(
            "attribute_code"=> "url_path",
            "value"=> $product['options']['url_path'],
        )*/
		)
		 
    )
);

//var_dump($data); exit;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $URL . "/rest/V1/products/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "content-type: application/json",
    "authorization: Bearer XXXXXXXXXXXXXXX YOUR KEY XXXXXXXXXX"// . $key,
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}