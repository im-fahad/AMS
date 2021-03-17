<?php

namespace App\Http\Controllers\Api;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Image;

class CompanyController extends Controller
{
    public function companyList()
    {
        $companies = Company::all();
        return res($companies);
    }

    public function getCompany(Company $company)
    {
        return res($company);
    }

    public function create(CompanyRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = uniqid('company_') . '.' . $logo->getClientOriginalExtension();
            $path = public_path('images/company/' . $logo_name);
            Image::make($logo)->resize(200, 200)->save($path);
            $data['logo'] = $logo_name;
        }

        Company::create($data);

        return success_res('Successfully Company Created!');
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = uniqid('company_') . '.' . $logo->getClientOriginalExtension();
            $path = public_path('images/company/' . $logo_name);
            if (File::exists('images/company/' . $company->logo)) {
                File::delete('images/company/' . $company->logo);
            }
            Image::make($logo)->save($path);
            $data['logo'] = $logo_name;
        }

        $company->update($data);

        return success_res('Successfully Company Updated!');
    }

    public function delete(Company $company)
    {
        if (auth()->user()->id == $company->creator_id || auth()->user()->role == Role::SUPER_ADMIN) {
            $company->delete();

            if (File::exists('images/company/' . $company->logo)) {
                File::delete('images/company/' . $company->logo);
            }

            return success_res('Successfully Company Deleted!');
        }

        return unauthorized_res();
    }
}
