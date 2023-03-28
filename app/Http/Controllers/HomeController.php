<?php

namespace App\Http\Controllers;

use App\Models\expenses;
use App\Models\sale;
use App\Models\sold_items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\product;
use App\Models\purchase;
use App\Models\purchased;
use App\Models\inventory_items;

class HomeController extends Controller
{
    public function redirect()
    {
        $user=Auth::id();
        if($user)
        {
            $username=Auth::user()->name;
            $sales=sold_items::all();
            $total_sales=0;
            $profit=0;
            foreach ($sales as $sales)
            {
                $total_sales=$total_sales + $sales->total_price;
                $profit=$profit + $sales->profit;
            }
            $purchase=purchased::all();
            $total_purchase=0;
            foreach ($purchase as $purchase)
            {
                $total_purchase=$total_purchase + $purchase->total_price;
            }
            $expenses=expenses::all();
            $total_expenses=0;
            foreach ($expenses as $expenses)
            {
                $total_expenses=$total_expenses + $expenses->amount;
            }
            $total= $total_sales - $total_purchase;
            $profit_value = $total - $total_expenses;
            $profit=$profit - $profit_value;
            return view('admin.home', compact('username', 'total_expenses', 'total_purchase', 'total_sales', 'profit'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function registration()
    {
        return redirect('register');
    }
    public function add_product()
    {
        $user=Auth::id();
        if($user)
        {
            $username=Auth::user()->name;
            $category=category::all();
            return view('admin.add_product', compact('username', 'category'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function adding_product(Request $request)
    {
        $data=new product;
        $data->product_title=$request->title;
        $data->product_category=$request->category;
        $data->purchase_price=$request->purchase_price;
        $data->sale_price=$request->sale_price;
        $data->save();
        return redirect()->back()->with('message', 'Product Added Successfully');
    }
    public function product()
    {
        $user=Auth::id();
        if($user)
        {
            $username=Auth::user()->name;
            $product=product::all();
            return view('admin.product', compact('username', 'product'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function delete_product($id)
    {
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }
    public function edit_product($id)
    {
        $user=Auth::id();
        if($user)
        {
            $username=Auth::user()->name;
            $category=category::all();
            $product=product::find($id);
            return view('admin.edit_product', compact('product', 'category', 'username'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function update_product(Request $request, $id)
    {
        $product=product::find($id);
        $product->product_title=$request->title;
        $product->product_category=$request->category;
        $product->purchase_price=$request->purchase_price;
        $product->sale_price=$request->sale_price;
        $product->save();
        return redirect()->back()->with('message', 'Product Update Successfully');
    }
    public function sale_product(Request $request)
    {
        $id= $request->input('product_id');
        $product_exist_id=inventory_items::where('item_id','=', $id)->get('id')->first();
        $inventory=inventory_items::find($product_exist_id)->first();
        $quantity=$inventory->quantity;
        $sale_quantity= $request->input('quantity');
        if ($sale_quantity <= $quantity)
        {
            $product=product::find($id);
            $data= new sale;
            $data->product_title=$product->product_title;
            $data->product_category=$product->product_category;
            $data->sale_price=$request->sale_price;
            $data->Quantity=$sale_quantity;
            $data->item_id=$product->id;
            $data->save();
            return redirect()->back()->with('message', 'Added to sales table');
        }
        else
        {
            return redirect()->back()->with('message', 'Out of stock');
        }

    }
    public function sale()
    {
        $user=Auth::id();
        if($user)
        {
            $username=Auth::user()->name;
            $sale=sale::all();
            return view('admin.sale', compact('sale', 'username'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function sold(Request $request, $id, $item_id)
    {
        $data=sale::find($id);
        $product=product::find($item_id);
        $product_exist_id=inventory_items::where('item_id','=', $item_id)->get('id')->first();
        $inventory=inventory_items::find($product_exist_id)->first();
        $sold= new sold_items;
        if($request->quantity <= $inventory->quantity)
        {
            $sale_price=$request->sale_price;
            $sold->product_title=$data->product_title;
            $sold->product_category=$data->product_category;
            if($sale_price != $product->sale_price)
            {
                $product->sale_price=$sale_price;
                $product->save();
                $sold->sale_price=$sale_price;
            }
            else
            {
                $sold->sale_price=$sale_price;
            }
            $sold->quantity=$request->quantity;
            $sold->item_id=$item_id;
            $sold->sale_id=$id;
            $quantity=$request->quantity;
            $total_price=$quantity * $sale_price;
            $sold->total_price=$total_price;
            $price= $inventory->purchase_price;
            $purchase_price=$quantity * $price;
            $profit=$total_price - $purchase_price;
            $inventory_quantity=$inventory->quantity;
            $inventory->quantity=$inventory_quantity - $quantity;
            $sold->profit=$profit;
            $inventory->save();
            $sold->save();
            $data->delete();
            return redirect()->back()->with('message', 'Sold Successfully');
        }
        else
        {
            return redirect()->back()->with('message', 'Out of Stock ');
        }
    }
    public function delete_sale($id)
    {
        $data=sale::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Deleted');
    }
    public function purchase_product(Request $request)
    {
        $id= $request->input('product_id');
        $product=product::find($id);
        $data=new purchase;
        $data->product_title=$product->product_title;
        $data->product_category=$product->product_category;
        $data->purchase_price=$request->purchase_price;
        $purchase_quantity= $request->input('quantity');
        $data->quantity=$purchase_quantity;
        $data->item_id=$product->id;
        $data->save();
        return redirect()->back()->with('message', 'Added to purchase table');
    }
    public function purchase()
    {
        $user=Auth::id();
        if($user)
        {
            $username=Auth::user()->name;
            $purchase=purchase::all();
            return view('admin.purchase', compact('purchase', 'username'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function purchased(Request $request, $id, $item_id)
    {
        $data=purchase::find($id);
        $product=product::find($item_id);
        $purchased= new purchased;
        $product_exist_id=inventory_items::where('item_id','=', $item_id)->get('id')->first();
        if($product_exist_id)
        {
            $inventory=inventory_items::find($product_exist_id)->first();
            $quantity=$inventory->quantity;
            $inventory->quantity=$quantity + $request->quantity;
            $price=$request->purchase_price;
            if($price != $product->purchase_price)
            {
                $product->purchase_price=$price;
                $product->save();
                $inventory->purchase_price=$price;
            }
            else
            {
                $inventory->purchase_price=$price;
            }
            $total=$inventory->total_price;
            $inventory->total_price=$total + $request->quantity * $price;
            $inventory-> save();
            $purchased->product_title=$data->product_title;
            $purchased->product_category=$data->product_category;
            $purchased->purchase_price=$price;
            $purchased->quantity=$request->quantity;
            $purchased->item_id=$item_id;
            $purchased->purchase_id=$id;
            $purchased->total_price=$request->quantity * $price;
            $purchased->save();
            $data->delete();
            return redirect()->back()->with('message', 'Purchased Successfully');
        }
        else
        {
            $inventory= new inventory_items;
            $inventory->product_title=$data->product_title;
            $inventory->product_category=$data->product_category;
            $price=$request->purchase_price;
            if($price != $product->purchase_price)
            {
                $product->purchase_price=$price;
                $product->save();
                $inventory->purchase_price=$price;
            }
            else
            {
                $inventory->purchase_price=$price;
            }
            $inventory->sale_price=$product->sale_price;
            $inventory->quantity=$request->quantity;
            $inventory->item_id=$item_id;
            $inventory->purchase_id=$id;
            $inventory->total_price=$request->quantity * $price;
            $inventory-> save();
            $purchased->product_title=$data->product_title;
            $purchased->product_category=$data->product_category;
            $purchased->purchase_price=$price;
            $purchased->quantity=$request->quantity;
            $purchased->item_id=$item_id;
            $purchased->purchase_id=$id;
            $purchased->total_price=$request->quantity * $price;
            $purchased->save();
            $data->delete();
            return redirect()->back()->with('message', 'Purchased Successfully');
        }

    }
    public function delete_purchase($id)
    {
        $data=purchase::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Deleted');
    }
    public function category()
    {
        $user=Auth::id();
        if($user)
        {
            $username=Auth::user()->name;
            $data=category::all();
            return view('admin.add_category', compact('username', 'data'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function add_expenses()
    {
        $user=Auth::id();
        if($user)
        {
            $expenses=expenses::all();
            $username=Auth::user()->name;
            return view('admin.add_expenses', compact('username', 'expenses'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function adding_expenses(Request $request)
    {
        $data=new expenses;
        $data->description=$request->description;
        $data->amount=$request->amount;
        $data->save();
        return redirect()->back()->with('messsage', 'Expenses Add to table');
    }
    public function add_category(Request $request)
    {
        $data=new category;
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
    }
    public function delete_category($id)
    {
        $data=category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Delete Successfully');
    }
    public function inventory()
    {
        $user=Auth::id();
        if($user)
        {
            $username=Auth::user()->name;
            $inventory=inventory_items::all();
            return view('admin.inventory' , compact('inventory', 'username'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function delete_inventory($id)
    {
        $data=inventory_items::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Deleted Successfully');
    }
    public function purchased_item()
    {
        $username=Auth::user()->name;
        $purchased=purchased::all();
        return view('admin.purchased', compact('purchased', 'username'));
    }
    public function sold_item()
    {
        $username=Auth::user()->name;
        $sold=sold_items::all();
        return view('admin.sold', compact('username', 'sold'));
    }
    public function add_sales($id)
    {
        $products = product::find($id);
        return response()->json([
            'status' =>200,
            'products' => $products,
        ]);
    }
    public function add_purchase($id)
    {
        $products = product::find($id);
        return response()->json([
            'status' =>200,
            'products' => $products,
        ]);
    }
}
