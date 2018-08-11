<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use App\Product;
use App\Fabricator;

class CalibrationController extends Controller
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
        $products = Product::with('fabricator')->orderBy('date_control_calibration', 'asc')->paginate(10);

        return view('dashboard.calibrations.index', compact('products'));
    }

    public function create()
    {
        $products = Product::get();
        $fabricators = Fabricator::all(['id', 'name']);

        return view('dashboard.products.create', compact('products', 'fabricators'));
    }

    public function store(Request $request)
    {

        $mytimePlusYear = Carbon\Carbon::now()->addYear();

        $newProduct = ([
            'name' => $request->name,
            'model' => $request->model, 
            'serial_number' => $request->serial_number, 
            'internal_code' => $request->internal_code, 
            'date_last_calibration' => $request->date_last_calibration, 
            'date_control_calibration' => $mytimePlusYear->toDateTimeString(),  
            'delivery_status' => $request->delivery_status,
            'status' => $request->status,
            'others' => $request->others,
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
        $product = Product::with('fabricator')->find($id);
        $fabricators = Fabricator::all(['id', 'name']);

        return view('dashboard.products.edit', compact('product', 'fabricators'));
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

        $mytime = Carbon\Carbon::now();
        $mytimePlusYear = Carbon\Carbon::now()->addYear();

        if ($request->status == 1 && $request->delivery_status == 1) {
            $control_last_calibration = $mytimePlusYear;
        } else {
            $control_last_calibration = $mytime;
        }

        

        $product->update([
            'name' => $request->name,
            'model' => $request->model, 
            'serial_number' => $request->serial_number, 
            'internal_code' => $request->internal_code, 
            'date_last_calibration' => $request->date_last_calibration, 
            'date_control_calibration' => $control_last_calibration,  
            'delivery_status' => $request->delivery_status,
            'status' => $request->status,
            'others' => $request->others,
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
