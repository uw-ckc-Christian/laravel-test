<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $companies = (new Company)->latest()->paginate(5);

        //for pagination switch between Tailwind and Bootstrap see: App\Providers\AppServiceProvider.php
        return view('companies',compact('companies'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.companyCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $request->validate(array(
            'name' => 'required', 'website' => 'nullable|string',
            'email' => 'nullable|email:filter', 'logo' => 'mimes:jpeg,png')
        );

        $cmp = new Company();
        $cmp->name = $request->name;
        $cmp->email = $request->email;

        if ( $request->logo !== null ) {
            $logo_img = time() . hash( 'crc32', $request->logo->getContent() ) . '.' . $request->logo->extension();
            $request->logo->storeAs( 'public', $logo_img );

            $cmp->logo = $logo_img;
        }

        $cmp->website = $request->website;
        $id = $cmp->save();

        //return back()->with('success', 'Zapisano.');
        return redirect('/companies')->with('success', 'Zapisano.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $company = (new Company)::with('employees')->get()->find( $id );

        return view('dashboard.companyShow', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit( Company $company ) {
        return view('dashboard.companyEdit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id) {
    public function update( Request $request, Company $company ) {
        $request->validate(array(
            'name' => 'required', 'website' => 'nullable|string',
            'email' => 'nullable|email:filter', 'logo' => 'mimes:jpeg,png')
        );

        $request->name !== $company->name && $company->name = $request->name;
        $request->email !== $company->email && $company->email = $request->email;

        if ( $request->logo !== $company->logo && $company->logo !== null ) {
            //no action for separately removing a logo so, not uploading a new file is considered an attempt of removing the current one
            Storage::delete( 'public/' . $company->logo );
        }

        if ( $request->logo !== null ) {
            $logo_img = time() . hash( 'crc32', $request->logo->getContent() ) . '.' . $request->logo->extension();
            $request->logo->storeAs( 'public', $logo_img );

            $company->logo = $logo_img;
        }

        $request->website !== $company->website && $company->website = $request->website;
        $company->save();

        return back()->with('success', 'Zmiany zostały zapisane.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id) {
    public function destroy( Company  $company ) {
        if ( $company->logo !== null ) {
            Storage::delete( 'public/' . $company->logo );
        }
        $company->delete();

        return redirect('/companies')->with('success', 'Firma została usunięta.');
    }
}
