<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="pagestyle" href="{{asset('assets/sales')}}/css/app.min.css" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="{{asset('assets/sales')}}/img/favicon.png">
    <link href="{{asset('assets/sales')}}/css/style.css" rel="stylesheet"/>

    <style>


        body {
            margin: 0;
            padding: 0;
        }

        @page {
            /*size: A4;*/
            margin: 0;
        }
        @font-face {
            font-family: 'Almarai-Regular';
            font-style: normal;
            font-weight: 400;
            src: url({{url('assets/sales/webfonts/Almarai-Regular.ttf')}}) format('ttf');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        *{
            font-family: 'Almarai-Regular';
        }

        /*@media print {*/
        /*    .page {*/
        /*        margin: 0;*/
        /*        border: initial;*/
        /*        border-radius: initial;*/
        /*        width: initial;*/
        /*        min-height: initial;*/
        /*        box-shadow: initial;*/
        /*        background: initial;*/
        /*        page-break-after: always;*/
        /*    }*/
        /*}*/

    </style>
</head>

<body onload="window.print()">


<div class="multisteps-form container">
    <div class="row">
        <div class=" col-lg-3 p-1 m-auto ">
            <div class=" bill">
                <h4 class="font-weight-bolder ps-2">Bill</h4>
                <div class="info">
                    <h6 class="billTitle"> ticket <span dir="rtl"> {{$ticket->custom_id}}#</span></h6>
                    <ul>
                        <li><label> Visit Date : </label>
                            <strong> {{date('d  / m / Y',strtotime($ticket->day))}} </strong></li>
                        <li><label> Reservation Duration : </label> <strong> {{$ticket->hours_count}} h </strong></li>
                        <li><label> Shift : </label> <strong> {{date('hA',strtotime($ticket->shift->from))}}
                                : {{date('hA',strtotime($ticket->shift->to))}} </strong></li>
                        <li><label> Print Time : </label> <strong> {{$date}} </strong></li>
                    </ul>
                </div>

                @if(count($models))
                    <div class="info">
                        <h6 class="billTitle"> visitors</h6>
                        <div class="items">
                            <div class="itemsHead row">
                                <span class="col">type</span>
                                <span class="col"> Quantity </span>
                                <span class="col"> price </span>
                            </div>
                            @foreach($models as $model)
                                <div class="item row">
                                    <span class="col">{{$model->type->title}}</span>
                                    <span class="col"> x{{$model->count_all}} </span>
                                    <span class="col">EGP {{$model->sum_all}}  </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(count($ticket->products))

                    <div class="info">
                        <h6 class="billTitle"> products</h6>
                        <div class="items">
                            <div class="itemsHead row">
                                <span class="col">type</span>
                                <span class="col"> Quantity </span>
                                <span class="col"> price </span>
                            </div>
                            @foreach($ticket->products as $product)
                                <div class="item row">
                                    <span class="col">{{$product->product->title}}</span>
                                    <span class="col"> x{{$product->qty}} </span>
                                    <span class="col">EGP {{$product->total_price}}  </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="info">
                    <h6 class="billTitle"> Totals </h6>
                    <ul>
                        <li><label> total price : </label> <strong>  EGP {{$ticket->grand_total}} </strong></li>
                        <li><label> Discount : </label> <strong> EGP {{$ticket->discount_value}} </strong></li>
                        <li><label> Remaining : </label> <strong> EGP {{$ticket->rem_amount}}</strong></li>
                        <li><label> paid : </label> <strong> EGP {{$ticket->paid_amount}}</strong></li>
                        <li><label> Change : </label> <strong> EGP {{$ticket->rem_amount - $ticket->paid_amount}}</strong></li>
                    </ul>
                </div>
                <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($ticket->custom_id, $generatorPNG::TYPE_CODE_128)) }}"
                     class="barcode">
            </div>
        </div>
    </div>
</div>
</body>

</html>
