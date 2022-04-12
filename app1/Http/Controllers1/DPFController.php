<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Converter;
use View;

use App\Models\Bill;

class pdfController extends Controller
{
    public function show($id)
    {
        $bill = Bill::whereId($id)->with('tickets')->first();

        if ($bill->status == 0) {
            $bill->update(['status'=> 1]);

            $bill->code = str_limit($bill->tickets->first()['code'], 8);
            $tnm = $bill->tickets[0]->code;
            $html =  View::make('admin.invoice', compact('bill'))->render();

            $conv = new \Anam\PhantomMagick\Converter();
            $conv->addPage($html)
                ->save(public_path().'/assets/tickets/P-'.$tnm.'.pdf'); 
            // Converter::addPage($html)
            //     ->toPdf()
            //     ->download('P-'.$tnm.'.pdf');

            return response()->json(['success' => __('label.printfSuc')]);
        } else
        return response()->json(['error' => __('label.printfErr')]);
    }
}
