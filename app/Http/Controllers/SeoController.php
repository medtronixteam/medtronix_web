<?php

namespace App\Http\Controllers;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function manage(){
        return view('employee.seo_manage');
        }

        public function store(Request $request){
            $request->validate([
                'seo' => 'required',
            ]);

            Seo::updateOrCreate(
                ['type' => 'meta_tag'],
                ['seo' => $request->seo],
            );

            flashy()->success('Data has been updated');
            return redirect()->back();
        }

}
