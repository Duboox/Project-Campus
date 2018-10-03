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

        $searchField2 =  Input::get('field2');
        $searchInput2 =  Input::get('input2');

        $searchRelation = false;
        $searchRelation2 = false;

        if ($searchField == 'client' || $searchField == 'fabricator') {
            $searchRelation = true;
        }
        if ($searchField2 == 'client' || $searchField2 == 'fabricator') {
            $searchRelation2 = true;
        }

        if (empty($searchInput)) {
            // si no hay search en el primer campo
            $products = Product::with('client', 'fabricator')->orderBy('id', 'desc')->paginate(10);
        } else {
            if (empty($searchInput2)) {
                // si no hay search en el segundo campo
                if ($searchRelation) {
                    //si hay relacion en search
                    $products = Product::with('client', 'fabricator')
                        ->whereHas($searchField, function ($query) use ($searchInput) {
                            $query->where('name', 'like', '%'. $searchInput .'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(500);
                } else {
                    //si NO hay relacion en search
                    $products = Product::with('client', 'fabricator')
                        ->where($searchField, 'like', '%'. $searchInput .'%')
                        ->orderBy('id', 'desc')
                        ->paginate(500);
                }
            } else {
                // si estan el primer y segundo campo en search
                if ($searchRelation && $searchRelation2) {
                    // si ambos campos tienen relacion
                    $products = Product::with('client', 'fabricator')
                        ->whereHas($searchField, function ($query) use ($searchInput) {
                            $query->where('name', 'like', '%'. $searchInput .'%');
                        })
                        ->whereHas($searchField2, function ($query) use ($searchInput2) {
                            $query->where('name', 'like', '%'. $searchInput2 .'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(500);
                } else {
                    if ($searchRelation) {
                        // si el primer campo tiene relacion
                        $products = Product::with('client', 'fabricator')
                            ->Where($searchField2, 'like', '%'. $searchInput2 .'%')
                            ->whereHas($searchField, function ($query) use ($searchInput) {
                                $query->where('name', 'like', '%'. $searchInput .'%');
                            })
                            ->orderBy('id', 'desc')
                            ->paginate(500);
                    } else if ($searchRelation2) {
                        // si el segundo campo tiene relacion
                        $products = Product::with('client', 'fabricator')
                            ->where($searchField, 'like', '%'. $searchInput .'%')
                            ->whereHas($searchField2, function ($query) use ($searchInput2) {
                                $query->where('name', 'like', '%'. $searchInput2 .'%');
                            })
                            ->orderBy('id', 'desc')
                            ->paginate(500);
                    } else {
                        // si ningun campo tiene relacion
                        $products = Product::with('client', 'fabricator')
                            ->where($searchField, 'like', '%'. $searchInput .'%')
                            ->Where($searchField2, 'like', '%'. $searchInput2 .'%')
                            ->orderBy('id', 'desc')
                            ->paginate(500);
                    }
                }
            }
        }
        
        return view('dashboard.products.index', compact('products'));
    }

    public function searchIncoming()
    {
        $searchSince =  Input::get('since');
        $searchUntil =  Input::get('until');
        $products = Product::with('client', 'fabricator')
        ->whereBetween('created_at', [$searchSince, $searchUntil])
        ->where([
            ['status', '=', '0'],
            // ['delivery_status', '=', '0']
        ])
        ->orderBy('id', 'desc')->paginate(500);

        return view('dashboard.products.index', compact('products'));
    }

    public function searchDischarged()
    {
        $searchSince =  Input::get('since');
        $searchUntil =  Input::get('until');
        $products = Product::with('client', 'fabricator')
        ->whereBetween('created_at', [$searchSince, $searchUntil])
        ->where('status', '=', '1')
        // ->where('delivery_status', '=', '1')
        ->orderBy('id', 'desc')->paginate(500);

        return view('dashboard.products.index', compact('products'));
    }

    public function searchNoCalibrated()
    {
        $mytime = Carbon::now()->toDateTimeString();
        // dd($mytime);
        $products = Product::with('client', 'fabricator')
        ->where(function ($query) {
            $query->where('date_control_calibration', '<=', '2018-09-28');
        })->where(function ($query) {
            $query->where('delivery_status', '=', 0)
                  ->orWhere('delivery_status', '=', NULL);
        })
        ->orderBy('id', 'desc')->paginate(500);

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
        $newClient = null;
        $newFabricator = null;

        return view('dashboard.products.create', compact('products', 'fabricators', 'clients', 'newClient', 'newFabricator'));
    }

    public function store(Request $request)
    {
        $lastRecord = Product::latest('id')->first();

        $request->validate([
            'name' => 'required',
            // 'model' => 'required', 
            // 'serial_number' => 'required', 
            // 'internal_code' => 'required', 
            // 'date_last_calibration' => 'required',
            // 'status' => 'required',
            // 'delivery_status' => 'required',
            'magnitude' => 'required',
            'id_client' => 'required',
            'id_fabricator' => 'required',
        ]);

        $mytimePlusYear = Carbon::now()->addYear();

        $newProduct = ([
            'mc' => $lastRecord->mc + 1,
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
            'Equipo creado éxitosamente!!!'
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
        $request->validate([
            'name' => 'required',
            'model' => 'required', 
            'serial_number' => 'required', 
            'internal_code' => 'required', 
            'date_last_calibration' => 'required',
            'status' => 'required',
            'delivery_status' => 'required',
            'magnitude' => 'required',
            'id_client' => 'required',
            'id_fabricator' => 'required',
        ]);
        
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
            'Equipo actualizado éxitosamente!!!'
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
            'Equipo eliminado éxitosamente!!!'
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
