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
        $currentYear = Carbon::now()->year;

        $products = Product::with('fabricator')
        ->whereYear('date_control_calibration', $currentYear)
        ->orderBy('date_control_calibration', 'asc')->paginate(10);

        return view('dashboard.calibrations.index', compact('products'));
    }


    public function edit($id)
    {
        $product = Product::with('fabricator')->find($id);
        $fabricators = Fabricator::all(['id', 'name']);

        return view('dashboard.calibrations.edit', compact('product', 'fabricators'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $mytime = Carbon::now();
        $mytimePlusYear = Carbon::now()->addYear();

        if ($request->status == 1) {
            $date_last_calibration = $mytime;
            $date_control_calibration = $mytimePlusYear;
        } else {
            $date_last_calibration = $product->date_last_calibration;
            $date_control_calibration = $product->date_control_calibration;
        }

        

        $product->update([
            'name' => $product->name,
            'model' => $product->model, 
            'serial_number' => $product->serial_number, 
            'internal_code' => $product->internal_code, 
            'date_last_calibration' => $date_last_calibration, 
            'date_control_calibration' => $date_control_calibration,  
            'delivery_status' => $request->delivery_status,
            'status' => $request->status,
            'others' => $product->others,
            'id_fabricator' => $product->id_fabricator
            ]);

        return save_response($product, 'products.index', 
            'Equipo actualizado éxitosamente!!!'
        ); 
    }

}
