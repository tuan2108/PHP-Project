<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
   public function index(Request $request){
    // $category = CategoryModel::all();
    $searchKeyword = $request->query('category_name',"");
    $sort = $request->query('sort',"");

    $queryORM = CategoryModel::where('name', "LIKE", "%" .$searchKeyword. "%");
    if($sort == "name_asc"){
        $queryORM = $queryORM->orderBy('name', 'asc');
    }
    if($sort == "name_desc"){
        $queryORM = $queryORM->orderBy('name', 'desc');
    }
    $category = $queryORM->paginate(10);
    $data = [];
    $data["category"] = $category;
    $data["sort"] = $sort;
    
    $data["searchKeyword"] = $searchKeyword;
    return view("backend.category.index", $data);
   }

   public function create(){

    return view("backend.category.create");
   }

   public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'desc' => 'required',
            'image' => 'required',
        ]);
        
        $category_name = $request->input('name', '');
        $category_slug = $request->input('slug', '');
        $category_desc = $request->input('desc', '');
        $pathCategoryImage = $request->file('image')->store('public/CategoryImages');

        $category = new CategoryModel();
        
        $category->name = $category_name ;
        $category->slug = $category_slug;
        $category->desc = $category_desc;
        $category->image = $pathCategoryImage;
        $category->save();
        return redirect("/backend/category/index");
   }

   public function edit($id){
        $category = CategoryModel::findOrFail($id);

        $data  = [];
        $data["category"] = $category;
    return view("backend.category.edit", $data);
   }

   public function update(Request $request, $id){
       $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'desc' => 'required',
       ]);

       $category_name = $request->input('name', '');
       $category_slug = $request->input('slug', '');
       $category_desc = $request->input('desc', '');

       $category = CategoryModel::findOrFail($id);

       $category->name = $category_name;
       $category->slug = $category_slug;
       $category->desc = $category_desc;
       
       if($request->hasFile('image')){
        // n???u c?? ???nh m???i upload l??n v?? trong bi???n $product->produt_image ???? c?? d??? li???u c?? nghiex l?? tr?????c ???? ???? c?? ???nh trong db
        if($category->image){
            Storage::delete($category->image);
        }
        $pathCategoryImage = $request->file('image')->store('public/CategoryImages');
        $category->image = $pathCategoryImage;
        }

       $category->save();

       return redirect("backend/category/edit/$id")->with('status', 'C???p nh???t s???n ph???m th??nh c??ng');
   }

   public function delete($id){
        $category = CategoryModel::findOrFail($id);

        $data = [];
        $data["category"] = $category;
    return view("backend.category.delete", $data);
   }

   public function destroy($id){
        $countProducts = DB::table('products')->count();
        if($countProducts > 0){
            return redirect("/backend/category/index")->with('status', 'X??a t???t c??? c??c s???n ph???m thu???c danh m???c n??y tr?????c khi x??a danh m???c!');
        }

       $category = CategoryModel::findOrFail($id);
       $category->delete();
       return redirect("/backend/category/index")->with('status', 'X??a s???n ph???m th??nh c??ng');
   }
}
