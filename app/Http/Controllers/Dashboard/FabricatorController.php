<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use App\Fabricator;

class FabricatorController extends Controller
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
        $this->middleware('permission:fabricators.index')->only('index');
        $this->middleware('permission:fabricators.create')->only('create');
        $this->middleware('permission:fabricators.edit')->only('edit');
        $this->middleware('permission:fabricators.update')->only('update');
        $this->middleware('permission:fabricators.destroy')->only('destroy');
        // pdf
        $this->middleware('permission:fabricators.pdf.view')->only('clientPDFview');


       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fabricators = Fabricator::orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.fabricators.index', compact('fabricators'));
    }

    public function create()
    {
        $fabricators = Fabricator::get();

        return view('dashboard.fabricators.create', compact('fabricators'));
    }

    public function store(Request $request)
    {

        $newFabricator = ([
            'name' => $request->name,
            'description' => $request->description, 
            'id_user' => Auth::user()->id
            ]);

        $fabricator = Fabricator::create($newFabricator);

        return save_response($fabricator, 'fabricators.index', 
            'Fabricante creado éxitosamente!!!'
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
        $fabricator = Fabricator::find($id);

        return view('dashboard.fabricators.edit', compact('fabricator'));
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
        $fabricator = Fabricator::find($id);

        $fabricator->update([
            'name' => $request->name,
            'description' => $request->description, 
            ]);

        return save_response($fabricator, 'fabricators.index', 
            'Fabricante actualizado éxitosamente!!!'
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
        $fabricator = Fabricator::find($id);

        $fabricator->delete();

        return save_response($fabricator, 'fabricators.index', 
            'Fabricante eliminado éxitosamente!!!'
        ); 
    }

    /**
     * userPDFview
     *
     * @return pdf generate
     */
    public function fabricatorPDFview()
    {
        return view('dashboard.fabricators.pdf.index');
    }

    /**
     * userPDFreport
     *
     * @return pdf report all
     */
    public function AllfabricatorPDF()
    {
        $fabricators = Fabricator::all();

        $pdf = PDF::loadView('dashboard.fabricators.pdf.archive', compact('fabricators'));
        
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
    public function fabricatorPDFreport(Request $request)
    {
        $this->validate($request, ['from' => 'required', 'to' => 'required']);

        $fabricators = Fabricator::whereBetween('created_at', [$request->from, $request->to])->get();
        
        $pdf = PDF::loadView('dashboard.fabricators.pdf.archive', compact('fabricators'));
        
        $pdf->output();
        
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(10, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, [0, 0, 0]);

        return $pdf->stream();
    }

}
