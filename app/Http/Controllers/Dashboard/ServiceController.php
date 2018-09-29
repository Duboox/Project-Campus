<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Response;
use Carbon\Carbon;
use PDF;
use App\Service;
use App\Client;
use App\Product;

class ServiceController extends Controller
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
        $this->middleware('permission:service.index')->only('index');
        $this->middleware('permission:service.create')->only('create');
        $this->middleware('permission:service.edit')->only('edit');
        $this->middleware('permission:service.update')->only('update');
        $this->middleware('permission:service.destroy')->only('destroy');
        // pdf
        $this->middleware('permission:service.pdf.view')->only('clientPDFview');


       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //  $products = Product::with('client', 'fabricator')->get();
            
            //  $mytime = Carbon::now();

            //  foreach ($products as $product) {
            //     $newService = ([
            //         'date_entry' => $mytime->toDateTimeString(),
            //         'date_return' => $mytime->toDateTimeString(), 
            //         'id_client' => $product->client->id, 
            //         'id_product' => $product->id,
            //         'observation' => 'No aplica',
            //         'id_user' => Auth::user()->id
            //     ]);
            //     $service = Service::create($newService);
            //  }


         $services = Service::with(['product' => function ($query) {
             $query->where('delivery_status', '=', '0');
         }])
        ->with('client', 'product.fabricator')
        ->orderBy('id', 'desc')
        ->paginate(10);

         return view('dashboard.services.index', compact('services'));
    }


    public function search() 
    {
        $currentYear = Carbon::now()->year;
        $searchField =  Input::get('field');
        $searchInput =  Input::get('input');

        if (empty($searchInput)) {
            $services = Service::with(['product' => function ($query) {
                $query->where('delivery_status', '=', '0');
            }])
           ->with('client', 'product.fabricator')
           ->orderBy('id', 'desc')
           ->paginate(10);
        } else {
            if ($searchField == 'client') {
                $services = Service::whereHas('client', function ($query) use ($searchInput) {
                    $query->where('name', 'like', '%'. $searchInput .'%');
                })
                ->with('client', 'product')
                ->orderBy('created_at', 'asc')
                ->paginate(500);
            } else if ($searchField == 'product') {
                $services = Service::whereHas('product', function ($query) use ($searchInput) {
                    $query->where('name', 'like', '%'. $searchInput .'%');
                })
                ->with('client', 'product')
                ->orderBy('created_at', 'asc')
                ->paginate(500);
            } else {
                $services = Service::with('client', 'product')
                ->where($searchField, 'like', '%'. $searchInput .'%')
                ->orderBy('created_at', 'asc')
                ->paginate(500);
            }
        }
        
        return view('dashboard.services.index', compact('services'));
    }

    public function show(Request $request, $id)
    {

        $service = Service::with('client', 'product.fabricator')->find($id);

        //return view('dashboard.services.pdf.service', compact('service'));
        
        $pdf = PDF::loadView('dashboard.services.pdf.service', compact('service'));
        
        $pdf->output();
        
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(10, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, [0, 0, 0]);

        return $pdf->stream();
    }

    public function certificate(Request $request, $id)
    {

        $service = Service::with('client', 'product.fabricator')->find($id);

        //return view('dashboard.services.pdf.service', compact('service'));
        
        $pdf = PDF::loadView('dashboard.services.pdf.certificate', compact('service'));
        
        $pdf->output();
        
        $dom_pdf = $pdf->getDomPDF();

        // $canvas = $dom_pdf ->get_canvas();
        // $canvas->page_text(10, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, [0, 0, 0]);

        return $pdf->stream();
    }

    public function uploadCertificate(Request $request)
    {

        $file = $request->file('certificate');
        $fileName = $file->getClientOriginalName();
        $fileExt = $file->getClientOriginalExtension();

        // Storage::disk('certificates')->putFile($fileName, $file);
        // Storage::putFile('certificates', $request->file('certificate'));

        Storage::disk('certificates')->putFileAs('uploads', $file, $request->serviceID.'.'.$fileExt);

        $service = Service::find($request->serviceID);
        $product = Product::find($service->id_product);

        $service->update([
            'certificate' => $request->serviceID.'.'.$fileExt
            ]);

        $product->update([
            'status' => 1,
            'delivery_status' => 1, 
        ]);

        return save_response($fileName, 'services.index', 
        'Certificado subido éxitosamente!!!'
        ); 
    }

    public function downloadCertificate(Request $request, $id)
    {   
        $service = Service::find($id);

        $file_path = public_path('certificates/uploads/'.$service->certificate);

        $headers = array(
            'Content-Type: ' . mime_content_type( $file_path ),
        
        );

        // dd($file_path);

        return \Redirect::to('certificates/uploads/'.$service->certificate);

        // $service = Service::find($id);
        // return Storage::disk('certificates')->download('uploads/' . $service->certificate, $service->certificate, $headers);
    }

    public function create()
    {
        $clients = Client::all(['id', 'name']);
        $products = Product::all(['id', 'name']);

        return view('dashboard.services.create', compact('clients', 'products'));
    }

    public function store(Request $request)
    {

        $product = Product::with('client', 'fabricator')->find($request->productID);

        $mytime = Carbon::now();
        $mytimeDateReturn = Carbon::now()->addDays(3);
        $mytimeDateLastCalibration = Carbon::now()->addDays(3);
        $mytimeDateNextCalibration = $mytimeDateReturn->addYear();

        $newService = ([
            'date_entry' => $mytime->toDateTimeString(),
            'date_return' => $mytimeDateReturn->toDateTimeString(), 
            'id_client' => $product->client->id, 
            'id_product' => $product->id,
            'observation' => $request->observation,
            'id_user' => Auth::user()->id
            ]);

         $product->update([
             'date_last_calibration' => $mytimeDateLastCalibration->toDateTimeString(), 
             'date_control_calibration' => $mytimeDateNextCalibration->toDateTimeString(),  
             ]);

        $service = Service::create($newService);

        return save_response($service, 'services.index', 
            'Solicitud creada éxitosamente!!!'
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
        $service = Service::with('client', 'product.fabricator')->find($id);
        $clients = Client::all(['id', 'name']);
        $products = Product::all(['id', 'name']);

        return view('dashboard.services.edit', compact('service', 'clients', 'products'));
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
        $service = Service::find($id);

        $service->update([
            'date_entry' => $request->date_delivery,
            'date_return' => $request->date_return, 
            'id_client' => $request->id_client, 
            'id_product' => $request->id_product
            ]);

        return save_response($service, 'services.index', 
            'Solicitud actualizada éxitosamente!!!'
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
        $service = Service::find($id);

        $service->delete();

        return save_response($service, 'services.index', 
            'Solicitud eliminada éxitosamente!!!'
        ); 
    }

    /**
     * userPDFview
     *
     * @return pdf generate
     */
    public function servicePDFview()
    {
        return view('dashboard.services.pdf.index');
    }

    /**
     * userPDFreport
     *
     * @return pdf report all
     */
    public function AllservicePDF()
    {
        $services = Service::all();

        $pdf = PDF::loadView('dashboard.services.pdf.archive', compact('services'));
        
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
    public function servicePDFreport(Request $request)
    {
        $this->validate($request, ['from' => 'required', 'to' => 'required']);

        $services = Service::whereBetween('created_at', [$request->from, $request->to])->get();
        
        $pdf = PDF::loadView('dashboard.services.pdf.archive', compact('services'));
        
        $pdf->output();
        
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(10, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, [0, 0, 0]);

        return $pdf->stream();
    }

}
