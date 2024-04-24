<?php 

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use App\Models\SellerModel;

class SellerProductController extends Controller
 {

    public function addProductPage()
    {
        $data = SellerModel::find(session('seller'));
       return view('seller.dashboard.product.addProduct',['seller'=>$data]);
    }
}


