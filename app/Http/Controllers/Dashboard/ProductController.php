<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use PDF;
use App\Product;
use App\Fabricator;
use App\Client;

class ProductController extends Controller
{

    /**
     * __construct
     *
     * @return Language selected in the application
     */

    public function __construct()
    {
        Carbon::setlocale(config('app.locale'));

        // middleware
        $this->middleware('permission:products.index')->only('index');
        $this->middleware('permission:products.create')->only('create');
        $this->middleware('permission:products.edit')->only('edit');
        $this->middleware('permission:products.update')->only('update');
        $this->middleware('permission:products.destroy')->only('destroy');
        // pdf
        $this->middleware('permission:products.pdf.view')->only('productPDFview');


       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('client', 'fabricator')->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.products.index', compact('products'));
    }

    public function search() 
    {
        $searchField =  Input::get('field');
        $searchInput =  Input::get('input');
        
        if ($searchField == 'client') {
            $products = Product::whereHas('client', function ($query) use ($searchInput) {
                $query->where('name', 'like', '%'. $searchInput .'%');
            })
            ->with('client', 'fabricator')
            ->orderBy('id', 'desc')
            ->paginate(500);
        } else if ($searchField == 'fabricator') {
            $products = Product::whereHas('fabricator', function ($query) use ($searchInput) {
                $query->where('name', 'like', '%'. $searchInput .'%');
            })
            ->with('client', 'fabricator')
            ->orderBy('id', 'desc')
            ->paginate(500);
        } else {
            $products = Product::with('client', 'fabricator')
            ->where($searchField, 'like', '%'. $searchInput .'%')
            ->orderBy('id', 'desc')
            ->paginate(500);
        }
        
        return view('dashboard.products.index', compact('products'));
    }

    public function searchIncoming()
    {
        $searchSince =  Input::get('since');
        $searchUntil =  Input::get('until');
        $products = Product::with('client', 'fabricator')
        ->whereBetween('created_at', [$searchSince, $searchUntil])
        ->where('status', '=', '0')
        ->where('delivery_status', '=', '0')
        ->orderBy('created_at', 'desc')->paginate(500);

        return view('dashboard.products.index', compact('products'));
    }

    public function searchDischarged()
    {
        $searchSince =  Input::get('since');
        $searchUntil =  Input::get('until');
        $products = Product::with('client', 'fabricator')
        ->whereBetween('created_at', [$searchSince, $searchUntil])
        ->where('status', '=', '1')
        ->where('delivery_status', '=', '1')
        ->orderBy('created_at', 'desc')->paginate(500);

        return view('dashboard.products.index', compact('products'));
    }

    public function service(Request $request)
    {
        $productId = $request->productID;

        $product = Product::with('client', 'fabricator')->find($productId);

        return view('dashboard.services.create', compact('product'));
    }

    public function create()
    {
        $products = Product::get();
        $clients = Client::all(['id', 'name']);
        $fabricators = Fabricator::all(['id', 'name']);

        return view('dashboard.products.create', compact('products', 'fabricators', 'clients'));
    }

    public function store(Request $request)
    {

        $mytimePlusYear = Carbon::now()->addYear();

        $newProduct = ([
            'name' => $request->name,
            'model' => $request->model, 
            'serial_number' => $request->serial_number, 
            'internal_code' => $request->internal_code, 
            'date_last_calibration' => $request->date_last_calibration, 
            'date_control_calibration' => $mytimePlusYear->toDateString(),  
            'status' => $request->status,
            'delivery_status' => $request->delivery_status,
            'others' => $request->others,
            'magnitude' => $request->magnitude,
            'id_client' => $request->id_client,
            'id_fabricator' => $request->id_fabricator,
            'id_user' => Auth::user()->id
            ]);

        $product = Product::create($newProduct);

        return save_response($product, 'products.index', 
            'Producto creado éxitosamente!!!'
        ); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('client', 'fabricator')->find($id);
        $clients = Client::all(['id', 'name']);
        $fabricators = Fabricator::all(['id', 'name']);

        return view('dashboard.products.edit', compact('product', 'fabricators', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->update([
            'name' => $request->name,
            'model' => $request->model, 
            'serial_number' => $request->serial_number, 
            'internal_code' => $request->internal_code, 
            'date_last_calibration' => $request->date_last_calibration, 
            'date_control_calibration' => $request->date_control_calibration,  
            'status' => $request->status,
            'delivery_status' => $request->delivery_status,
            'others' => $request->others,
            'magnitude' => $request->magnitude,
            'id_fabricator' => $request->id_fabricator
            ]);

        return save_response($product, 'products.index', 
            'Producto actualizado éxitosamente!!!'
        ); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return save_response($product, 'products.index', 
            'Producto eliminado éxitosamente!!!'
        ); 
    }

    /**
     * userPDFview
     *
     * @return pdf generate
     */
    public function productPDFview()
    {
        return view('dashboard.products.pdf.index');
    }

    /**
     * userPDFreport
     *
     * @return pdf report all
     */
    public function AllproductPDF()
    {
        $products = Product::all();

        $pdf = PDF::loadView('dashboard.products.pdf.archive', compact('products'));
        
        $pdf->output();
        
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(10, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, [0, 0, 0]);

        return $pdf->stream();
    }

    /**
     * userPDFreport
     *
     * @return pdf report whereDate
     */
    public function productPDFreport(Request $request)
    {
        $this->validate($request, ['from' => 'required', 'to' => 'required']);

        $products = Product::whereBetween('created_at', [$request->from, $request->to])->get();
        
        $pdf = PDF::loadView('dashboard.products.pdf.archive', compact('products'));
        
        $pdf->output();
        
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(10, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, [0, 0, 0]);

        return $pdf->stream();
    }

}
