<?php 
require 'vendor/autoload.php';
use Goutte\Client;
$client = new Client();
$crawler = $client->request("GET","https://www.watchshells.com/datejust/?idx=460");
echo $crawler -> filter('.goods_wrapper')->each(function ($node){
    // $img = $node->filter('.item > img')->attr('src');
    $product_name = $node->filter('.view_tit')->text();
    // $price = $node->filter( ".pay_number > span ")->text();
    
    $directory = "./images/$product_name";
    if(!is_dir($directory)){
        mkdir($directory,077,true);
    }

    $node->filter('.item img')->each(function($nodes) use ($directory){
        $imgURL = $nodes->attr('src');
        $imageName = basename($imgURL);
        $imagePath = "$directory/$imageName";
        file_put_contents($imagePath , file_get_contents($imgURL));
    });
});
?>