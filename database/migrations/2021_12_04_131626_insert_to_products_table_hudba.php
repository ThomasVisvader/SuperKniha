<?php

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertToProductsTableHudba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $product = new Product;
        $product['title'] = 'Znovuzrodenie';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Album od skupiny Tublatanka.';
        $product['rating'] = 3.0;
        $product['language'] = 'slovenský';
        $product['type'] = 'hudba';
        $product['author'] = 'Tublatanka';
        $product['genre'] = 'rock';
        $product['length'] = '00:42:58';
        $product->save();

        $image = new Image;
        $image['image'] = 'Tublatanka-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'Tublatanka-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Requiem';
        $product['price'] = 9.99;
        $product['quantity'] = 45;
        $product['description'] = 'Album od Wolfganga Amadea Mozarta.';
        $product['rating'] = 5.0;
        $product['language'] = 'latinský';
        $product['type'] = 'hudba';
        $product['author'] = 'Wolfgang Amadeus Mozart';
        $product['genre'] = 'klasická hudba';
        $product['length'] = '00:53:38';
        $product->save();

        $image = new Image;
        $image['image'] = 'Mozart-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'Mozart-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Hodina nehy';
        $product['price'] = 9.99;
        $product['quantity'] = 50;
        $product['description'] = 'Album od skupiny Elán.';
        $product['rating'] = 4.7;
        $product['language'] = 'slovenský';
        $product['type'] = 'hudba';
        $product['author'] = 'Elán';
        $product['genre'] = 'pop-rock';
        $product['length'] = '1:05:25';
        $product->save();

        $image = new Image;
        $image['image'] = 'Elan-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'Elan-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Valec';
        $product['price'] = 9.99;
        $product['quantity'] = 50;
        $product['description'] = 'Album od skupiny IMT Smile.';
        $product['rating'] = 4.2;
        $product['language'] = 'slovenský';
        $product['type'] = 'hudba';
        $product['author'] = 'IMT Smile';
        $product['genre'] = 'pop-rock';
        $product['length'] = '1:05:25';
        $product->save();

        $image = new Image;
        $image['image'] = 'IMT-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'IMT-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Čumil';
        $product['price'] = 9.99;
        $product['quantity'] = 50;
        $product['rating'] = 4.1;
        $product['description'] = 'Album od skupiny Iné kafe.';
        $product['language'] = 'slovenský';
        $product['type'] = 'hudba';
        $product['author'] = 'Iné kafe';
        $product['genre'] = 'punk-rock';
        $product['length'] = '00:45:42';
        $product->save();

        $image = new Image;
        $image['image'] = 'IneKafe-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'IneKafe-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'XMas';
        $product['price'] = 9.99;
        $product['quantity'] = 50;
        $product['rating'] = 4.7;
        $product['description'] = 'Vianočný album od rôznych interpretov.';
        $product['language'] = 'anglický';
        $product['type'] = 'hudba';
        $product['author'] = 'Rôzni interpreti';
        $product['genre'] = 'vianočné';
        $product['length'] = '00:52:41';
        $product->save();

        $image = new Image;
        $image['image'] = 'Xmas-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'Xmas-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Invincible';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Album od Michaela Jacksona.';
        $product['rating'] = 4.9;
        $product['language'] = 'anglický';
        $product['type'] = 'hudba';
        $product['author'] = 'Michael Jackson';
        $product['genre'] = 'pop';
        $product['length'] = '1:17:01';
        $product->save();

        $image = new Image;
        $image['image'] = 'MJ-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'MJ-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'The Division Bell';
        $product['price'] = 9.99;
        $product['quantity'] = 90;
        $product['description'] = 'Album od skupiny Pink FLoyd.';
        $product['rating'] = 5.0;
        $product['language'] = 'anglický';
        $product['type'] = 'hudba';
        $product['author'] = 'Pink Floyd';
        $product['genre'] = 'rock';
        $product['length'] = '1:06:23';
        $product->save();

        $image = new Image;
        $image['image'] = 'PinkFloyd-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'PinkFloyd-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Bob Dylan';
        $product['price'] = 9.99;
        $product['quantity'] = 90;
        $product['rating'] = 2.8;
        $product['description'] = 'Album od Boba Dylana.';
        $product['language'] = 'anglický';
        $product['type'] = 'hudba';
        $product['author'] = 'Bob Dylan';
        $product['genre'] = 'country';
        $product['length'] = '1:04:18';
        $product->save();

        $image = new Image;
        $image['image'] = 'BobDylan-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'BobDylan-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Millenium Hits';
        $product['price'] = 9.99;
        $product['quantity'] = 90;
        $product['description'] = 'Album od skupiny Rammstein.';
        $product['rating'] = 4.5;
        $product['language'] = 'nemecký';
        $product['type'] = 'hudba';
        $product['author'] = 'Rammstein';
        $product['genre'] = 'metal';
        $product['length'] = '1:19:14';
        $product->save();

        $image = new Image;
        $image['image'] = 'Rammstein-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'Rammstein-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Miro Žbirka - Best of the best';
        $product['price'] = 9.99;
        $product['quantity'] = 90;
        $product['description'] = 'Album od Mira Žbirku.';
        $product['rating'] = 4.8;
        $product['language'] = 'slovenský';
        $product['type'] = 'hudba';
        $product['author'] = 'Miro Žbirka';
        $product['genre'] = 'pop';
        $product['length'] = '1:17:41';
        $product->save();

        $image = new Image;
        $image['image'] = 'Zbirka-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'Zbirka-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();

        $product = new Product;
        $product['title'] = 'Pesničky pre deti';
        $product['price'] = 9.99;
        $product['quantity'] = 90;
        $product['description'] = 'Album detských pesničiek od rôznych interpretov.';
        $product['rating'] = 2.8;
        $product['language'] = 'slovenský';
        $product['type'] = 'hudba';
        $product['author'] = 'Rôzni interpreti';
        $product['genre'] = 'detské';
        $product['length'] = '1:17:41';
        $product->save();

        $image = new Image;
        $image['image'] = 'Deti-1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $image = new Image;
        $image['image'] = 'Deti-2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 2;
        $image->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
