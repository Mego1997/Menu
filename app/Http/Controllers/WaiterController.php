<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\Waiter;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WaiterController extends Controller
{
   
    public function index()
    {
        $user = Auth::user()->id;
        $shop = Shop::where('user_id', $user)->first();
        $waiters = Waiter::where('shop_id',$shop->id)->get();

        return view('dashboard.waiters.index',compact('waiters'));
    }

    public function create()
    {
        return view('dashboard.waiters.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);

        $shop_user = Auth::user()->id;
        $shop = Shop::where('user_id', $shop_user)->first();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = 3;
        $user->save();

        Waiter::create([
            'name' => $request->name,
            'shop_id' => $shop->id,
            'user_id' => $user->id,
        ]);
        return redirect()->route('waiters.index')->with('message' , "Waiter Added Successfully");
    }

    public function edit($id)
    {
        $waiter = Waiter::find($id);
        $user = User::where('id',$waiter->user_id)->first();

        return view('dashboard.waiters.edit' , compact('waiter','user'));

    }

    public function update(Request $request, $id)
    {
        $waiter = Waiter::find($id);
        $user = User::where('id',$waiter->user_id)->first();

        if($request->password == null){
            $password = $user->password;
        }else{
            $password =Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->type = 3;
        $user->save();

        $waiter->name = $request->name;
        $waiter->save();
        return redirect()->route('waiters.index')->with('message' , "Waiter Updated Successfully");
    }
    
    public function destroy($id )
    {
        $waiter = Waiter::find($id)->delete();
        $user = User::where('id',$waiter->user_id)->delete();
        return redirect()->route('waiters.index')->with('message' , "Waiter Deleted Successfully");

    }

    public function checkWaiterOrders($waiter_id)
    {
        $newOrdersWaiter = Order::where('waiter_id', $waiter_id)
            ->where('status', 0) // Assuming 'status 0' represents new orders
            ->with('table')
            ->get();
    
        return response()->json(['newOrdersWaiter' => $newOrdersWaiter]);
    }

    public function order()
    {
        $user = Auth::user()->id;
        $waiter = Waiter::where('user_id', $user)->first();
        $waiter_id = $waiter->id;
        $orders = Order::where('status', 0)
            ->where('waiter_id', $waiter_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard.waiterorders.index', compact('orders'));
    }

    public function acceptedOrder()
    {
        $user = Auth::user()->id;
        $waiter = Waiter::where('user_id', $user)->first();
        $waiter_id = $waiter->id;
        $orders = Order::where('status', 1)
            ->where('waiter_id', $waiter_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard.waiterorders.acceptedOrder', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        $order_details = OrderDetails::where('order_id', $id)->get();
        $productss = Product::where('shop_id', $order->shop_id)->get();
        return view('dashboard.waiterorders.create', compact('order' , 'order_details' ,'productss'));
    }

    public function showacceptedOrder($id)
    {
        $order = Order::find($id);
        $order_details = OrderDetails::where('order_id', $id)->get();
        return view('dashboard.waiterorders.showAcceptedOrder', compact('order' , 'order_details' ));
    }

    public function waitergetPrice(Request $request)
    {
//        dd($request);
        $data['AllPrices'] = Product::where('id',$request->product_id)->get(["price"]);
        return response()->json($data);
    }

    public function orderapprove(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->total = $request->total;
        $order->status = 1;
        $order->save();
    
        foreach ($request->input('product_id') as $key => $class) {
            $orderDetails = OrderDetails::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'product_id' => $class,
                ],
                [
                    'quantity' => $request->quantity[$key],
                    'price' => $request->price[$key],
                    'total' => $request->subtotal[$key],
                ]
            );
        }
        return redirect()->route('acceptedOrders.index')->with('message' , "Order Approved Successfully");
    }
    




}
