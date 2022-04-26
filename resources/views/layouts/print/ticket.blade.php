<!DOCTYPE html>
<html lang="en" dir="rtl">
<title>{{$setting->title}} | #{{$ticket->ticket_num}}</title>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="pagestyle" href="{{asset('assets/sales')}}/css/app.min.css" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="{{asset('assets/sales')}}/img/favicon.png">
    <link href="{{asset('assets/sales')}}/css/style.css" rel="stylesheet"/>
    <style>
        body {
            direction: ltr;
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
    </style>
</head>

<body onload="window.print()">


<div class="multisteps-form container">
    <div class="row">
        <div class=" col-lg-3 p-1 m-auto ">
            <div class=" bill">
                <h4 class="font-weight-bolder ps-2">Bill</h4>
                <div class="info">
                    <h6 class="billTitle"> ticket <span dir="rtl"> {{$ticket->ticket_num}}#</span></h6>
                    <ul>
                        <li><label> Cashier Name : </label> <strong> {{auth()->user()->name}} </strong></li>
                        <li><label> Visit Date : </label>
                            <strong> {{date('d  / m / Y',strtotime($ticket->visit_date))}} </strong></li>
                        <li><label> Reservation Duration : </label> <strong> {{$ticket->hours_count}} h </strong></li>
                        <li><label> Print Time : </label> <strong> {{$date}} </strong></li>
                    </ul>
                </div>

                @if(count($models))
                    <div class="info">
                        <h6 class="billTitle"> visitors</h6>
                        <div class="items">
                            <div class="itemsHead row">
                                <span class="col"> name </span>
                                <span class="col">type</span>
                                @if($ticket->status == 'in')
                                <span class="col"> bracelet </span>
                                @endif
                                <span class="col"> price </span>
                            </div>
                            @foreach($models as $model)
                                <div class="item row">
                                    <span class="col"> {{($model->name) ?? '---'}} </span>
                                    <span class="col">{{$model->type->title}}</span>
                                    @if($ticket->status == 'in')
                                        <span class="col">{{$model->bracelet_number}}  </span>
                                    @endif
                                    <span class="col"> {{$model->price}} EGP </span>
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
                                    <span class="col"> {{$product->qty}} </span>
                                    <span class="col"> {{$product->total_price}} EGP </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="info">
                    <h6 class="billTitle"> Totals </h6>
                    <ul>
                        <li><label> total price : </label> <strong>   {{$ticket->grand_total}} EGP</strong></li>
                        @if($ticket->discount_value != 0)
                        <li><label> Discount : </label> <strong> {{$ticket->discount_value}} {{($ticket->discount_type == 'per') ? '%' : 'EGP'}}</strong></li>
                        @endif
                        <li><label> paid : </label> <strong>  {{$ticket->paid_amount}} EGP</strong></li>
                        <li><label> Remaining : </label> <strong>  {{$ticket->rem_amount}} EGP</strong></li>
                    </ul>
                </div>

                <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($ticket->ticket_num, $generatorPNG::TYPE_CODE_128)) }}"
                     class="barcode">
            </div>
        </div>
    </div>
</div>
</body>

</html>
