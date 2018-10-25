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

        $products = Product::with('client', 'fabricator')
        ->whereYear('date_control_calibration', $currentYear)
        ->orderBy('date_control_calibration', 'asc')->paginate(10);

        return view('dashboard.calibrations.index', compact('products'));
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
