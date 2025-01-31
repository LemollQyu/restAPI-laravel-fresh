<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ResponseFormatter;

class ProductController extends Controller
{
    //
    public function index (){
        // get

        // Search untuk produk di user aktif ini
        $query = auth()->user()->products();

        // tangkap search paramsnya jika tidak null maka query
        if(!is_null(request()->search)) {
            $query->where('name', 'LIKE', '%' . request()->search . '%');
        }

        // mengambil data product user yang sedang aktif
        // dan membuat fitur pagination
        $products = $query->paginate(request()->per_page);

        // terus benerin format datanya yang di paginantion
        $products->getCollection()->transform(function($item) {
            $response = $item->api_response;

            return $response;
        });

        return ResponseFormatter::success($products);

    }

    public function show (int $id){
        // get detail product
        // ini jika product yang di tuju tidak ada maka akan menampilan 404 notfound
        $product = auth()->user()->products()->findOrFail($id);


        return ResponseFormatter::success($product->api_response);

    }

    public function store (){
        // post

        // validation untuk data yang masuk itu haru seperti apa
        $validator = \Validator::make(request()->all(), $this->getValidation());

        if($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors(), []);
        }

        // login data ini dajadikan datu fungsi karena berulang
        // upload image

        // $payload = [
        //     'name' => request()->name,
        //     'description' => request()->description,
        //     'price' => request()->price,
        // ];

        // if(!is_null(request()->image)) {
        //     $payload['image'] = request()->file('image')->store(
        //         // disimpan di folder product-image, di didalam folder C:\Users\lenovo\desktop\lemoll\php\laravel\restAPI-laravel-fresh\storage\app\public
        //         'product-image', 'public'
        //     );
        // }


        // tambah data product
        $product = auth()->user()->products()->create($this->prepareData());

        // setelah dicreate return show detail nya, jadi ini akan manggil function show
        return $this->show($product->id);

    }

    public function  update(int $id){
        // put / putch
        // update product

        $validator = \Validator::make(request()->all(), $this->getValidation());

        if($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors(), []);
        }

        // logic ini dijadikan 1 fungsi

        // $payload = [
        //     'name' => request()->name,
        //     'description' => request()->description,
        //     'price' => request()->price,
        // ];

        // if(!is_null(request()->image)) {
        //     $payload['image'] = request()->file('image')->store(
        //         // disimpan di folder product-image, di didalam folder C:\Users\lenovo\desktop\lemoll\php\laravel\restAPI-laravel-fresh\storage\app\public
        //         'product-image', 'public'
        //     );
        // }

        // cari product yang mau di update
        $product = auth()->user()->products()->findOrFail($id);
        $product->update($this->prepareData());
        // dd($product);

        return $this->show($product->id);

    }

    public function destroy(int $id){
        // get delete
        // ambil productnya
        $product = auth()->user()->products()->findOrFail($id);

        // terus hapus
        $product->delete();

        return ResponseFormatter::success([
            'is_deleted' => true,
        ]);

        // membuat fitur mengahapus tapi di database itu masih ada istilahnya softDeletes, gampangnya seperti resyclaeTemp
        // caranya adalah membuat column di table baru dulu dengan nama add_soft_delete_on_[nama-table]s
        // isi format tablenya itu $table->softDeletes();
        // dan di model yang nanti di hapus sementara di kasih
        // use Illuminate\Database\Eloquent\SoftDeletes;
        // dan kemudian dipanggil use SoftDeletes

    }

    // rules unutk validation, tinggal panggil

    protected function getValidation() {
        return [
            'name' => 'required|min:2|max:20',
            'description' => 'nullable|max:200',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ];
    }

    // login yang berulang bisa dijadikan satu fungsi
    protected function prepareData() {
        $payload = [
            'name' => request()->name,
            'description' => request()->description,
            'price' => request()->price,
        ];

        if(!is_null(request()->image)) {
            $payload['image'] = request()->file('image')->store(
                // disimpan di folder product-image, di didalam folder C:\Users\lenovo\desktop\lemoll\php\laravel\restAPI-laravel-fresh\storage\app\public
                'product-image', 'public'
            );
        }

        return $payload;
    }




}
