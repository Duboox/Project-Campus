<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
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
        $services = Service::with('client', 'product.fabricator')->orderBy('created_at', 'desc')->paginate(10);

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

    public function create()
    {
        $clients = Client::all(['id', 'name']);
        $products = Product::all(['id', 'name']);

        return view('dashboard.services.create', compact('clients', 'products'));
    }

    public function store(Request $request)
    {

        $mytime = Carbon\Carbon::now();
        $newService = ([
            'date_entry' => $mytime->toDateTimeString(),
            'date_return' => $request->date_return, 
            'id_client' => $request->id_client, 
            'id_product' => $request->id_product,
            'id_user' => Auth::user()->id
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
