<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class MealController extends Controller
{


    public function index(){

        $meals = Meal::paginate(4);

        return view('meal.index',compact('meals'));
    }


    public function show(){

        $cats = Category::latest()->get();

        return view('meal.meal',compact('cats'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'description' => 'required|string|min:3|max:500',
            'price' => 'required|numeric',
            'photo' => 'required|mimes:png,jpeg,jpg'
        ]);

        $photo = $request->file('photo') ; // $image = clinic.jpg
        $photo_gen = hexdec(uniqid()). '.' . $photo->getClientOriginalExtension();
          // $abbr_image = 145236987452658.jpg
        Image::make($photo)->resize(300,300)->save('upload/meals/'.$photo_gen);

        $save_url = 'upload/meals/'. $photo_gen;

        Meal::insert([
            'category' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $save_url,
        ]);

        $notification = array(
			'message_id' => 'تم حفظ الوجبة بنجاح',
			'alert-type' => 'success'
		);

        return redirect()->route('meal_show')->with($notification);

        //return redirect()->route('meal_show')->with(['message' => 'تم حفظ الوجبة بنجاح']);

    }

    public function edit($id){

        $meals = Meal::find($id);
        $cats = Category::latest()->get();

        return view('meal.edit',compact('meals','cats'));

    }

    public function update(Request $request,$id){

       // $old_photo = $request->old_photo;

        if($request->has('photo')){

            //unlink($old_photo);

            // store new photo
            $photo = $request->file('photo') ; // $image = clinic.jpg
        $photo_gen = hexdec(uniqid()). '.' . $photo->getClientOriginalExtension();
          // $abbr_image = 145236987452658.jpg
        Image::make($photo)->resize(300,300)->save('upload/meals/'.$photo_gen);

        $save_url = 'upload/meals/'. $photo_gen;

            // update
            Meal::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'photo' => $save_url,

            ]);
            return redirect()->route('meal_index')->with('message', 'تم تعديل الوجبة بنجاح!');

        }else{
// update witout chang photo

            Meal::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            return redirect()->route('meal_index')->with('message', 'تم تعديل الوجبة بنجاح!');
        }

    }

    public function detailes($id){
        $meal =Meal::findOrFail($id);
        return view('meal.detailes',compact('meal'));

    }
}
