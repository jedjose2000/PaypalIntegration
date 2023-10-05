<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Orders extends Controller
{
    public function index(){
        if (Auth::check()) {
            $user = Auth::user();
            // Get the user ID of the authenticated user
            $userId = Auth::id();
            $pageTitle = "Orders";
            $orderModel = new OrderModel;
            $orders = OrderModel::where('accountId', $userId)->get();
            $data['results'] = $orders;
            $data['user'] = $user;
            return view('orders', $data + compact('pageTitle'));
        }
        return redirect()->route('home')->withErrors(['login_error' => 'Please login first!'])->withInput();
    }

    public function viewOrder(Request $request)
    {
        $orderId = $request->input('orderId');
        $orderModel = new OrderModel;
        $orders = $orderModel->viewProducts($orderId);
        $data["results"] = $orders;
        return response()->json($data);
    }
}
