<!DOCTYPE >
<html>
<head>
    <title>RECEIPT</title>
</head>
{{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
<style type="text/css">
     @page {
         size: 5.6cm auto ;  
        margin: 0;
        padding: 0;
        height: auto; 
        page-break-inside: avoid;
    } 

    body {
        font-family: 'Roboto Condensed', sans-serif;
        font-size: 5px;
        padding: 0;
        padding-top: 30px;
        margin: 10px;
    }
 
    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }


    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    } 

     table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 10px;
    }

    table tr td {
        font-size: 10px;
    }

    table {
        border-collapse: collapse;
    } 
     .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 10px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
        font-size: 20px;
    } 
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0">ABDUL WEB TECH</h1>
        <h1 class="text-center m-0 p-0">RECEIPT</h1>
    </div>
  
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">S/N</th>
                <th class="w-50">Product Name</th>
                <th class="w-50">Qty</th>
                <th class="w-50">Price</th>
             
            </tr>
            @php
                $a = 1;
                $sum = 0;
                foreach ($cart as $k) {
                    $sum += $k->price;
                }
            @endphp
            @foreach ($cart as $item)
                <tr align="center">
                    <td>{{ $a++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ round($item->price,2) }}</td>

                </tr>
            @endforeach



            <tr>
                <td colspan="7">
                    <div class="total-part">
                        <div class="total-left w-85 float-left" align="left">
                          
                            <p>TOTAL</p>
                        </div>
                        <div class="total-right w-15 float-left text-bold" align="right">
                      
                            <p>{{ round($sum,2) .'/='}}</p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</html>
