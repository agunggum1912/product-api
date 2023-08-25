<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function get_list(Request $request) {
        $rule = [
            'page'      => 'nullable|integer',
            'per_page'  => 'nullable|integer',
            'search'    => 'nullable|string',
            'order_by'  => 'nullable|in:name,email,role',
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

        $columns =  [
            'name'  => 'name',
            'email' => 'email',
            'role'  => 'role'
        ];

        $query = User::select('id', 'name', 'email', 'role');

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
                'email'     => $value->email,
                'role'      => config('main.role')[$value->role],
                'kode_role' => $value->role,
            ];
        }

        $data = [
            'total'     => $clone->count(),
            'data_list' => $list
        ];

        return $this->json200($data, "Get data user successfully.");
    }

    public function store(Request $request) {
        $rule = [
            'name'      => 'required',
            'email'     => 'required|email|unique:App\Models\User,email,0,id,deleted_at,NULL',
            'password'  => 'required|confirmed',
            'role'      => 'required|in:1,2',
        ];

        $validate = Validator::make($request->all(), $rule);
        if($validate->fails())
            return $this->json400($validate->errors()->first());

        DB::beginTransaction();
        try {
            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->role     = $request->role;
            $user->save();

            DB::commit();
            return $this->json201(null, 'Create user successfully.');
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
            'email'     => 'required|email|unique:App\Models\User,email,' . decrypt($id) . ',id,deleted_at,NULL',
            'role'      => 'required|in:1,2',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails())
            return $this->json400($validate->errors()->first());

        DB::beginTransaction();
        try {
            $product = User::find(decrypt($id));
            if(!$product)
                return $this->json400('Data not found.');

            $product->name          = $request->name;
            $product->email         = $request->email;
            $product->role          = $request->role;
            $product->save();

            DB::commit();
            return $this->json201(null, 'Update user successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->json400($e->getMessage());
        }
    }

    public function delete($id) {
        $check = $this->checkDecrypt([$id]);
        if ($check)
            return $this->json400($check->original['message']);

        $data = User::find(decrypt($id));
        if(!$data)
            return $this->json400('Data not found.');

        $data->delete();
        return $this->json400("User deleted successfully.");        
    }
}
