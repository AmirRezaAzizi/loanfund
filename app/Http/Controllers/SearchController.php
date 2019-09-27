<?php
/**
 * Created by PhpStorm.
 * User: amirreza
 * Date: 9/16/19
 * Time: 7:57 PM
 */

namespace App\Http\Controllers;


use App\Customer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::where('fname', 'LIKE', '%'.$request->search.'%')
            ->orWhere('lname', 'LIKE', '%'.$request->search.'%')
            ->orWhere('mobile', 'LIKE', '%'.$request->search.'%')
            ->orWhere('id', 'LIKE', '%'.$request->search.'%')
            ->get();

        $title = 'یافت شده';

        return view('owner.customers.index', compact('customers', 'title'));    }

}