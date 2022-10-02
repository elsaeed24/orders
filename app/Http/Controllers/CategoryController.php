<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::paginate(3);
        return view('category.category',compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['cat_name' => 'required|string|unique:categories|min:3|max:40']);

        Category::insert([
            'cat_name' => $request->cat_name,
            'created_at'=>Carbon::now()
        ]);

        return back()->with(['message' => 'تم اضافة هذا الصنف بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate(['cat_name' => 'required|string|unique:categories|min:3|max:40']);

        $id = $request->id ;
        Category::findOrFail($id)->update([

            'cat_name' => $request->cat_name,
            
        ]);
        return redirect()->route('cat_show')->with(['message' => 'تم تحديث هذا الصنف بنجاح']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('cat_show')->with(['message' => 'تم حذف هذا الصنف بنجاح']);

    }
}
