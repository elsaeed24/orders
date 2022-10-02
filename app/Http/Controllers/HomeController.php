<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(auth()->user()->is_admin == 1){

            $order=Order::orderBy('id','DESC')->get();

            return view('admin.admin',compact('order'));
        }else{

            $cats = Category::all();
            if(!$request->category){

                $cat1  = "الصفحة الرئيسية";

                $meals = Meal::latest()->get();
                return view('user.user',compact('meals','cats','cat1'));

            }else{

                $cat1 = $request->category;

                $meals = Meal::where('category',$request->category)->get();
                return view('user.user',compact('meals','cats','cat1'));

            }

        }
    }


    public function order_store(Request $request){

        // $request->validate([
        //     'phone' => 'required|numeric',
        //     'time' => 'required',
        //     'date' => 'required',
        //     'qty' => 'required',
        //     'address' => 'required'

        //     ]);

            Order::insert([

                'user_id'=>auth()->user()->id,
                'phone'=>$request->phone,
                'date'=>$request->date,
                'time'=>$request->time,
                'meal_id'=>$request->meal_id,
                'qty'=>$request->qty,
                'address'=>$request->address,
                'status'=>"تتم مراجعة الطلب"

            ]);

            $notification = array(
                'message_id' => 'تم الطلب  بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('home')->with($notification);

    }

    public function show_order(){

        $order=Order::where('user_id',auth::user()->id)->get();

        return view('order.show_order',compact('order'));

    }


    public function changeStatus(Request $request,$id){

        $order = Order::find($id);

         Order::where('id',$id)->update(['status'=> $request->status]);

         return back();

    }


}
