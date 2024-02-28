<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index()
    {
//        $request=request();
//         $query=Category::query();
//         $name= $request->query('name');
//         $status= $request->query('status');
//         if ($name){
//
//             $query->where('name','LIKE',$name);
//
//         }
//
//         if ($status){
//
//             $query->where('status',$status);
//
//         }



//        $categories =$query->paginate(2);

        $request = request();

        // SELECT a.*, b.name as parent_name
        // FROM categories as a
        // LEFT JOIN categories as b ON b.id = a.parent_id

        $categories = Category::with('parent')
            /*leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])*/
            //->select('categories.*')
            //->selectRaw('(SELECT COUNT(*) FROM products WHERE AND status = 'active' AND category_id = categories.id) as products_count')
            //->addSelect(DB::raw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id) as products_count'))
            ->withCount([
                'products as products_number' => function($query) {
                    $query->where('status', '=', 'active');
                }
            ])
//            ->filter($request->query())
            ->orderBy('categories.name')
            ->paginate(); // Return Collection object

        return view('Dashboard.categories.index', compact('categories'));
    }


    public function create()
    {

//        if (Gate::denies('categories.create')) {
//            abort(403);
//        }

//        $parents = Category::all();
//        $category = new Category();
//        return view('dashboard.categories.create', compact('category', 'parents'));
        $parents =Category::all();
        return view('dashboard.categories.create', compact('parents'));    }


    public function store(Request $request)
    {
//        Gate::authorize('categories.create');
//
//        $clean_data = $request->validate(Category::rules(), [
//            'required' => 'This field (:attribute) is required',
//            'name.unique' => 'This name is already exists!'
//        ]);
//
//        // Request merge
//        $request->merge([
//            'slug' => Str::slug($request->post('name'))
//        ]);
//
//        $data = $request->except('image');
//        $data['image'] = $this->uploadImgae($request);
//
//
//        // Mass assignment
//        $category = Category::create( $data );
//
//        // PRG


//        if ($request->hasFile('image')){
//
//            $image=$request->file('image');
//            $path=$image->store('categories_images',[
//
//                   'disk'=>'uploads',
//            ]);
//
//        }
        $request->validate(Category::rules(''),[

            'required'=>'the :attribute is required',
            'unique'=>'the :attribute already exists',

        ]);


        $request->merge([

            'slug'=>str::slug($request->post('name'))
        ]);
        $data = $request->except('image');

        $data['image']=$this->uploadImgae($request);


        $category = new Category($data);
        $category->save();
        return Redirect::route('categories.index')
            ->with('success', 'Category created!');
    }


    public function show(Category $category)
    {
//        if (Gate::denies('categories.view')) {
//            abort(403);
//        }

        return view('Dashboard.categories.show', [
            'category' => $category
        ]);
    }


    public function edit($id)
    {
//        Gate::authorize('categories.update');

        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('categories.index')
                ->with('info', 'Record not found!');
        }

        // SELECT * FROM categories WHERE id <> $id
        // AND (parent_id IS NULL OR parent_id <> $id)
        $parents = Category::where('id', '<>', $id)
            ->where(function($query) use ($id) {
                $query->whereNull('parent_id')
                      ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }


//    public function update(CategoryRequest $request, $id)
    public function update(Request $request, $id)
    {
        //$request->validate(Category::rules($id));

//        if ($request->hasFile('image')){
//
//            $image=$request->file('image');
//            $path=$image->store('categories_images',[
//
//                'disk'=>'public',
//            ]);
//
//        }
        $request->validate(Category::rules($id));


        $category = Category::findOrFail($id);

        $old_image = $category->image;
//
        $data = $request->except('image');
        $new_image = $this->uploadImgae($request);
//        $new_image = $request->file('image');
        if ($new_image) {
            $data['image'] = $new_image;
        }
//
        $category->update( $data );
//        $category->fill($request->all())->save();

        if ($old_image && $new_image) {
            Storage::disk('uploads')->delete($old_image);
        }

        return Redirect::route('categories.index')
            ->with('success', 'Category updated!');
    }


    public function destroy(Category $category)
    {
//        Gate::authorize('categories.delete');

        $category = Category::findOrFail($category->id);
        $category->delete();
        if ($category->image){

            Storage::disk('uploads')->delete($category->image);
        }

        //Category::where('id', '=', $id)->delete();
//        Category::destroy($category->id);


        return Redirect::route('categories.index')
            ->with('danger', 'Category deleted!');
    }

    protected function uploadImgae(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image'); // UploadedFile Object

            $path=$file->store('categories_images',[


                   'disk'=>'uploads',

                ]);


        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('Dashboard.categories.trash', compact('categories'));

    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('categories.trashed')
            ->with('success', 'Category restored!');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        if ($category->image) {
            Storage::disk('uploads')->delete($category->image);
        }

        return \redirect()->route('categories.trashed')
            ->with('success', 'Category deleted forever!');
    }
}
