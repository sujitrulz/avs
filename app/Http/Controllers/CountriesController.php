<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use Datatables;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $countries = Country::select('id', 'name', 'full_name', 'capital', 'currency', 'currency_symbol')
                            ->orderBy('name')->get();

        return View('admin.countries', [
                            'countries' => $countries
                            ]);                
    }

    public function data()
    {
        $users = User::select(['id', 'first_name', 'last_name', 'email']);

        return Datatables::of($users)
            ->add_column('actions','<a href="{{ route(\'admin.users.show\', $id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                                    <a href="{{ route(\'admin.users.edit\', $id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>
                				   ')
            ->make(true);
    }
}
