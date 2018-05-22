<?php

foreach($product['img'] as $img){

$curl = curl_init();
$URL = "http://XXXXXXXXXXXX MAGENTO 2 XXXXXXXX";
// print_r( $product);
$string = $img['file'];
$exploded = explode('/', $string);
$imgName = end($exploded);


$imagedata = file_get_contents($img['url']);
$base64 = base64_encode($imagedata);

$data = json_decode(' {
    "entry": {
        "media_type": "image",
        "label": "Image",
        "position": '.$img['position'].',
        "disabled": false,
        "types":  '.json_encode($img['types']).',
		"file": "'.$img['file'].'",
        "content": {
            "base64EncodedData": "'.$base64.'",
            "type": "'.image_type_to_mime_type(exif_imagetype($img['url'])).'",
            "name": "'.$imgName.'"
        }
    }
}', true);

print_r($data); 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $URL . "/rest/V1/products/".$product['options']['sku']."/media",
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

//break;
}