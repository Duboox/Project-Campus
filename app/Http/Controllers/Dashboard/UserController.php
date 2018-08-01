<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use Caffeinated\Shinobi\Models\Role;
use Carbon\Carbon;
use PDF;
use App\User;

class UserController extends Controller
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
        $this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.edit')->only('edit');
        $this->middleware('permission:users.update')->only('update');
        $this->middleware('permission:users.destroy')->only('destroy');
        // pdf
        $this->middleware('permission:users.pdf.view')->only('userPDFview');


       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->find($id);

        $roles = Role::all();

        $data = [$user, $roles];

        return view('dashboard.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserValidate $request, $id)
    {
        $user = User::find($id);

        $user->update(['name' => $request->name, 'email' => $request->email]);

        $user->roles()->sync($request->role);

        return save_response($user, 'users.index', 
            'Usuario actualizado éxitosamente!!!'
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
        $user = User::find($id);

        $response = $user->delete();

        return save_response($response, 'users.destroy', 
            'Usuario eliminado éxitosamente!!!'
        ); 
    }

    /**
     * userPDFview
     *
     * @return pdf generate
     */
    public function userPDFview()
    {
        return view('dashboard.users.pdf.index');
    }

    /**
     * userPDFreport
     *
     * @return pdf report all
     */
    public function AlluserPDF()
    {
        $users = User::all();

        $pdf = PDF::loadView('dashboard.users.pdf.archive', compact('users'));
        
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
    public function userPDFreport(Request $request)
    {
        $this->validate($request, ['from' => 'required', 'to' => 'required']);

        $users = User::whereBetween('created_at', [$request->from, $request->to])->get();
        
        $pdf = PDF::loadView('dashboard.users.pdf.archive', compact('users'));
        
        $pdf->output();
        
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(10, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, [0, 0, 0]);

        return $pdf->stream();
    }

}
