<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use PDF;

class ItemController extends Controller
{
    public function pdfview(Request $request)
    {
        $rules_data = $this->get_rules_data();
        return view('pages.pdfview')->with('rules_data', $rules_data);
    }
    function get_rules_data()
    {
        $rules_data = DB::table("rules")
                        -> limit(10)
                        ->get();
        return $rules_data;
    }
    function pdfconversion(Request $request)
    {
        $pdf  =  \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_rules_data_to_html());
        //$view =  View::make('auth.register')->render();
        //$pdf->loadHTML($view);
        $pdf->stream();
        //return $pdf->stream('invoice');
        return $pdf->download('profile.pdf');

        /*$pdf = \App::make('dompdf.wrapper');
        $pdf -> loadHTML($this -> convert_rules_data_to_html());
        $pdf -> stream();*/
    }
    function convert_rules_data_to_html()
    {
        $rules_data = $this->get_rules_data();
        $output = '
        <div class="container">
              <div style = "width: 200px;" id = "title" class="center">
              <h1  class="title is-2 is-vcentered" style=" margin-top: 20px !important;">Rules data</h1>
              </div>
          <div class="demo">
            <table class="table is-responsive center" style = "margin: auto;  margin-top: 30px !important;">
                    <thead>
                          <tr>
                              <th>Image</th>
                              <th>Title</th>
                              <th>Description</th>
                          </tr>
                    </thead>
                <tbody>
        ';
        foreach ($rules_data as $rule)
        {
            $output .= '<tr>
                          <td><img style = "width:209px;" src ="'. public_path() .'\img\chess_board.jpg"></td>
                          <td>'.$rule->title.'</td>
                          <td>'.$rule->description.'</td>
                      </tr>
            ';
        }
        $output .= '
                </tbody>
            </table>
          </div>

        </div>';
        return $output;

    }
}
