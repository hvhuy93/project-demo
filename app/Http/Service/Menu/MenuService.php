<?php


namespace App\Http\Service\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;


class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function create($request)
    {

        try {
            return Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => ( integer)$request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' => (string)$request->input('content'),
                'active' => (integer)$request->input('active'),
                'thumb' => (string)$request->input('thumb'),
                Session::flash('success', 'Add new category successful')
            ]);

        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function update($request, $menu): bool
    {
        if ($request->input('parent_id' != $menu->id)) {
            $menu->parent_id = (int)$request->input('parent_id');
        }
        $menu->name = (string)$request->input('name');
        $menu->description = (string)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (int)$request->input('active');
        $menu->thumb = (string)$request->input('thumb');
        $menu->save();

        Session::flash('success', ' Update Successful');
        return true;
    }

    public function show()
    {
        return Menu::select('id', 'name', 'thumb')
            ->orderByDESC('id')
            ->where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(100);
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }

    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()//relationship from model Menu
            ->select('id','name','price','price_sale','thumb')
            ->where('active',1);

        if ($request->input('price')){
            $query->orderBy('price', $request->input('price'));
        }
          return $query->orderByDesc('id')
                ->paginate(5)
              ->withQueryString();


    }

}
