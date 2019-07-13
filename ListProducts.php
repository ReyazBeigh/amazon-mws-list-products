<?php


require_once 'vendor/autoload.php';

chdir(__DIR__);

class AmazonListingApi {

	private $path;
	private $fileName;
	private $prductsArray;
	private $feedResponse;
	private $feedSubmissionId;
	private $channel;
	private $feedContent;

	function __construct(){
	
	}


	public function startOfProgram(){


        $creds = [
            'Marketplace_Id' => '',
            'Seller_Id' => '',
            'Access_Key_ID' => '',
            'Secret_Access_Key' => '',
            
        ];

       

		$client = new MCS\MWSClient($creds);
// some products
        $dataArray = [
            [
                'sku' =>'B077SNWFMN',
                'price'=> '70.01',
                'asin' =>  'B077SNWFMN',
                'quantity' => 10
            ], 
            [
                'sku' =>'B07SRR15GX',
                'price'=> '50.01',
                'asin' =>  'B07SRR15GX',
                'quantity' => 10
            ], 
          
            [
                'sku' =>'B002AGFUZ2',
                'price'=> '30.01',
                'asin' =>  'B002AGFUZ2',
                'quantity' => 20
            ]
           
        ];


        foreach($dataArray as $value):

        $product = new MCS\MWSProduct();
            $product->sku               =   $value['sku'];
            $product->price             =   $value['price'];
            $product->product_id        =   $value['asin'];
            $product->product_id_type   =   'ASIN';
            $product->condition_type    =   'New';
            $product->quantity          =   $value['quantity'];

            if ($product->validate()) {
               $this->prductsArray[] = $product;
            }else{
                $errors = $product->getValidationErrors();
                print_r($errors); exit; 
            }
          

        endforeach;
        
		$this->feedResponse = $client->postProduct($this->prductsArray);


        print_r($this->feedResponse);
       
	}


}

// }
$auFeed = new AmazonListingApi();
$auFeed -> startOfProgram();

   
    