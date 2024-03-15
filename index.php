
<?php 
require 'vendor/autoload.php';
use Goutte\Client;

$client = new Client();
$crawler = $client->request("GET", "https://www.watchshells.com/datejust/?idx=459");

$crawler->filter('.goods_wrapper')->each(function ($node) {
    $img = $node->filter('.item > img')->attr('src');
    $product_name = $node->filter('.view_tit')->text();
    $price = $node->filter(".pay_number > span")->text();

    // Create directory if it doesn't exist
    $category = 'rolex';
    $directory = "./images/$category/$product_name";
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    $node->filter('.item img')->each(function ($imgNode) use ($directory) {
        $imgUrl = $imgNode->attr('src');
        $imageName = basename($imgUrl);
        echo "$imageName";
        $imagePath = "$directory/$imageName";

        // Download and save the image
        file_put_contents($imagePath, file_get_contents($imgUrl));
    });
});
?> 
