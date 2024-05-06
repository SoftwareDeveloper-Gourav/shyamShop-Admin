<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\SellerModel;

class AdminPageController extends Controller {
    
    public function viewSeller()
    {
        $admin = Admin::find(session('admin'));
        $seller = SellerModel::orderBy('sellerId','DESC')->get();
       return view('admin.dashboard.seller.view_sellers',['admin'=>$admin,'seller'=>$seller]);
    }

}
