<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::latest();

        if (request('search')) {
            $company->where('name', 'like', '%' . request('search') . '%')
                ->orwhere('email', 'like', '%' . request('search') . '%')
                ->orwhere('website', 'like', '%' . request('search') . '%');
        }

        return view('dashboard.company', [
            "title" => "Company",
            "active" => "company",
            "company" => $company->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.company_insert',[
            "title" => "Insert Company",
            "active" => "company"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email:rfc,dns'],
            'logo_upload' => 'required|max:2000|mimes:png|dimensions:min_width=100,min_height=100',
        ]);

        $company = new Company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->name = $request->input('name');
        // image
        $logo_extension = $request->file('logo_upload')->extension();
        $logo_name = date('dmyHis') . '.' . $logo_extension;
        $path = Storage::putFileAs('company', $request->file('logo_upload'), $logo_name);
        // image
        $company->logo = $logo_name;

        $company->save();
        return redirect('/company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null(auth()->user())) {
            return redirect("/");
        }else {
            return view("dashboard/employee", [
                "title" => "Employee",
                "active" => "employee",
                "employee" => Company::find($id)->Employee()->paginate(5)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('dashboard.company_edit',[
            "title" => "Edit Company",
            "active" => "company"
        ], compact('company'));
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
        $destination = '/storage/app/company/' . $request->logo_old;
        if (file::exists($destination)) {
            File::delete($destination);
        }
        // image
        $logo_extension = $request->file('logo_upload')->extension();
        $logo_name = date('dmyHis') . '.' . $logo_extension;
        Storage::putFileAs('company', $request->file('logo_upload'), $logo_name);
        // image

        DB::table('companies')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'logo' => $logo_name,
                    'website' => $request->website
                ]);

        return redirect("/company");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destination = 'Storage/app/company/' . Company::find($id)->logo;
        if (Storage::exists('company/' . Company::find($id)->logo)) {
            File::delete($destination);
        }
        DB::table('employees')->where('company_id', '=', $id)->delete();
        DB::table('companies')->where('id', '=', $id)->delete();
        return redirect('/company');
    }
}
