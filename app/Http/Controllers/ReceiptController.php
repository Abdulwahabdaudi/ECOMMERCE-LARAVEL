<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
   public function receipt($receiptId)
   {
      $order = Order::latest()->where('id', '=', $receiptId)->get();

      $cart =  $order[0]->items()->get();

      $pdf = PDF::loadView('receipt', ['cart' => $cart])->setPaper([0, 0, 164, 800], 'portrait');

      $GLOBALS['bodyHeight'] = 0;

      $pdf->setCallbacks([
         'myCallbacks' => [
            'event' => 'end_frame', 'f' => function ($frame) {
               $node = $frame->get_node();
               if (strtolower($node->nodeName) === "body") {
                  $padding_box = $frame->get_padding_box();
                  $GLOBALS['bodyHeight'] += $padding_box['h'];
               }
            }
         ]
      ]);

      $pdf->render();

      $pdf = PDF::loadView('receipt', ['cart' => $cart])->setPaper([0, 0, 164, $GLOBALS['bodyHeight']+20], 'portrait');

      $pdf->render();
      
      return   $pdf->stream();
   }
}
