<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Drink;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Illuminate\Validation\Rules;


class AdminController extends Controller
{
    /**
     * Admin Seite anzeigen
     * @return Application|Factory|View
     */
    public function index(){
        return view('admin.index');
    }

    /**
     * Letztes Array erstelen
     * @return array
     */
    public function createLastExport(){
        return($this->createExport(Invoice::select('created_at')->orderByDesc('created_at')->first()->created_at));
    }

    /**
     * Abrechnung erstellen
     * @param $lastInvoice Ab wann soll die Abrechnung erstellt werden
     * @return array Array für die Abrechung
     */
    public function createExport($lastInvoice){
        //Größe des Arrays berechnen
        $y = User::select('id')
            ->orderByDesc('id')
            ->first()->id;
        $x = Drink::select('id')
            ->orderByDesc('id')
            ->first()->id;

        $users = User::all();
        $result = array_fill(0, $y+2, array_fill(0,$x+1,0));
        $drinks = Drink::all();
        //Biername und Preis einsezten
        foreach ($drinks as $drink){
            $result[0][$drink->id] = $drink->name;
            $result[1][$drink->id] = $drink->price;
        }

        //Daten in Array füllen
        foreach ($users as $user){
            $drinks = $user->drinks()->where('drinks.created_at', '>', $lastInvoice)->get();
            $result[$user->id+1][0] = $user->name;
            $result[$user->id+1][$x+1] = '=SUM(B'.($user->id+2).':'.chr($x+65).($user->id+2).')';
            foreach ($drinks as $drink){
                $result[$user->id+1][$drink->id]++;
            }
        }

        //Betrag mit Preis und Menge erechnen
        for ($i = 2; $i <= $y+0; $i++){
            for ($n = 1; $n <= $x+0; $n++){
                $result[$i][$n] *= $result[1][$n];
            }
        }
        //Tabelle Verschöneren
        $result[0][0] = null;
        $result[1][0] = 'Preis';

        return $result;
    }

    public function deleteUser(Request $request){
        User::find($request->id)->delete();
        return redirect('adminUser');
    }


    public function updateDrinks(Request $request, Drink $drink){
        $formField = $request->validate([
           'name' => ['required', 'string'],
           'barcode' => ['required', 'int'],
           'price' => 'required',
        ]);

        if ($request->hasFile('picture')){
            $formField['picture'] = $request->file('picture')->store('img', 'public');
        }
        $drink->update($formField);
        return redirect('admin/drinks');
    }

    public function createDrink(Request $request){
        $formField = $request->validate([
            'name' => ['required', 'string'],
            'barcode' => ['required', 'int'],
            'price' => ['required']
        ]);

        if ($request->hasFile('picture')){
            $formField['picture'] = $request->file('picture')->store('img', 'public');
        }
        Drink::create($formField);
        return redirect('admin/drinks');
    }

    public function updateUser(Request $request, User $user){
        $formField = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($request->has('password')){
            $request->validate([
                'password' => ['required', Rules\Password::defaults()],
            ]);
            $formField['password'] = Hash::make($request->password);
        }

        $user->update($formField);
        return redirect('admin/user');
    }

    public function downloadExport(Request $request){
        $invoice = Invoice::find($request->id);
        return Storage::download($invoice->download);
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function export(){
        $export = new UsersExport($this->createLastExport());
        $path = 'Bierrechnung/Bierrechnung_'.date("Ymd").'_'.uniqid().'.xlsx';

        Invoice::create(['download' => $path]);
        $this->setAmountToZero();

        Excel::store($export, $path);
        return Excel::download($export, 'Bierrechnung_'.date("Ymd").'.xlsx');
    }

    public function setAmountToZero(){
        $users = User::all();
        foreach ($users as $user){
            $user->amount = 0;
            $user->save();
        }
    }
}
