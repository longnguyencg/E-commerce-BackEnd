<?php


namespace App\Services;


use App\Category;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductServiceInterface;
use App\Product;
use App\ProductImage;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function findById($id)
    {
        return $this->productRepo->findById($id);
    }

    public function getAll()
    {
        $result = [];
        $products = $this->productRepo->getAll();
        foreach ($products as $product) {
            array_push($result,  array($product, $product->categories));
        }
        return $result;
    }

    public function store($request)
    {
        $product = new Product();
        $product->fill($request->all());
        $this->productRepo->store($product);
        $product->categories()->attach($request->categories);
        if ($request->images) {
            foreach ($request->images as $name) {
                $image = new ProductImage();
                $image->name = $name;
                $image->product_id = $product->id;
                $image->save();
            }
        }
    }

    public function search($keyword)
    {
        return $this->productRepo->search($keyword);
    }

    public function filter($request)
    {
        $where = [];
        foreach($request->categories as $category_id) {
            array_push($where, array('category_product.category_id','=',"$category_id"));
        }
        $sort = $request->sort ? $request->sort : 'ASC';
        $price = $request->price ? $request->price : 'DESC';


        $products = DB::table('products')
            ->join('category_product', 'products.id', '=', 'product_id')
            ->select('products.*')
            ->whereIn('category_product.category_id',$request->categories)
            ->groupBy('products.id')
            ->orderBy('price', $price)
            ->orderBy('created_at', $sort)
            ->get();
        return $products;
    }

    public function show($id)
    {
        if ($product = $this->productRepo->findById($id)) {
            return $product;
        }

        return false;
    }

    public function update($request, $id)
    {
        $product = $this->productRepo->findById($id);
        $product->update($request->all());
        $this->productRepo->update($product);
        $images = $product->productImages()->delete();
        if ($request->images) {
            foreach ($request->images as $name) {
                $image = new ProductImage();
                $image->name = $name;
                $image->product_id = $product->id;
                $image->save();
            }
        }

        return $product->categories()->sync($request->categories);
    }

    public function destroy($id)
    {
        if ($product = $this->productRepo->findById($id)) {
            $product->categories()->detach();
            return $this->productRepo->destroy($product);
        }
        return false;
    }

    public function getByCategory($category_id)
    {
        $result = [];
        $products = $this->productRepo->getByCategory($category_id);
        foreach ($products as $product) {
            array_push($result, array($product, $product->categories));
        }
        return $result;
    }

    public function hidden($request, $id)
    {
        if ($product = $this->productRepo->findById($id)) {
            $product->display = $request->display == true ? 1 : 0;
            return $this->productRepo->store($product);
        };
        return false;
    }
}
