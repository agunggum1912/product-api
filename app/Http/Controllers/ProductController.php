<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function get_list(Request $request) {
        $rule = [
            'page'      => 'nullable|integer',
            'per_page'  => 'nullable|integer',
            'search'    => 'nullable|string',
            'order_by'  => 'nullable|in:name,price',
            'sort'      => 'nullable|in:desc,asc',
        ];

        $validator = Validator::make($request->all(), $rule, [
            'sort.required'     => 'Key sort not found.',
            'order_by.required' => 'Order by not found',
        ]);

        if ($validator->fails())
            return $this->json400($validator->errors()->first());

        $search     = $request->search;
        $order_by   = $request->order_by ?: 'name';
        $sort       = $request->sort ?: 'asc';
        $page       = (int) $request->page ?: 1;
        $per_page   = (int) $request->per_page ?: 10;
        $offset     = ($page - 1) * $per_page;

        $columns =  ['name' => 'name','price' => 'price'];

        $query = Product::select('id', 'name', 'price', 'image');

        if ($search) {
            $query = $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $value)
                    $q->orWhere($value, 'like', "%$search%");
            });
        }

        $clone      = clone $query;
        $get_data   = $query->orderBy($columns[$order_by], $sort)->skip($offset)->take($per_page)->get();

        $list = [];
        foreach ($get_data as $value) {
            $list[] = [
                'id'        => encrypt($value->id),
                'name'      => $value->name,
                'price'     => $value->price,
                'image'     => $value->image,
            ];
        }

        $data = [
            'total'     => $clone->count(),
            'data_list' => $list
        ];

        return $this->json200($data, "Get data book successfully.");
    }

    public function store(Request $request) {
        $rule = [
            'name'      => 'required',
            'price'     => 'required|integer',
            'image'     => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if($validate->fails())
            return $this->json400($validate->errors()->first());

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->name      = $request->name;
            $product->price     = $request->price;
            $product->image     = $request->image;
            $product->save();

            DB::commit();
            return $this->json201(null, 'Create product successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->json400($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $check = $this->checkDecrypt([$id]);
        if ($check)
            return $this->json400($check->original['message']);

        $rule = [
            'name'      => 'required',
            'price'     => 'required|integer',
            'image'     => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails())
            return $this->json400($validate->errors()->first());

        DB::beginTransaction();
        try {
            $product = Product::find(decrypt($id));
            if(!$product)
                return $this->json400('Data not found.');

            $product->name         = $request->name;
            $product->price        = $request->price;
            $product->image        = $request->image;
            $product->save();

            DB::commit();
            return $this->json201(null, 'Update product successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->json400($e->getMessage());
        }
    }

    public function delete($id) {
        $check = $this->checkDecrypt([$id]);
        if ($check)
            return $this->json400($check->original['message']);

        $data = Product::find(decrypt($id));
        if(!$data)
            return $this->json400('Data not found.');

        $data->delete();
        return $this->json400("Product deleted successfully.");        
    }
}
