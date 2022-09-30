<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Drink;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class UserController extends Controller
{
    /**
     * Login per Barcode
     * (I know unischer)
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function barcodeLogin(Request $request){
        $request->validate([
            'barcode' => 'required|exists:users,barcode'
        ]);
        $barcode = $request->all();
        $user = User::where('barcode', $barcode["barcode"])->first();


        auth::loginUsingId($user->id);
        return redirect('presssystem/user');
    }

    /**
     * Getränk abscannen
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function saveDrink(Request $request){
        $request->validate([
            'barcode' => 'required|exists:drinks,barcode'
        ]);

        $barcode = $request->all();
        $drink = Drink::where('barcode', $barcode["barcode"])->first();

        $user = \auth()->user();

        $user->amount = $user->amount + $drink->price;
        $user->save();

        $user->drinks()->save($drink);

        return redirect('presssystem/user');
    }



}
