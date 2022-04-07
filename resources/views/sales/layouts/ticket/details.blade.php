<style>
    .myTable, .myTable th,.myTable td {
        border:1px solid grey;
    }
</style>
<table class="myTable" style="width:100%">
    <tr style="background-color: #a6c64c;color: white">
        <th>Visitors</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    @foreach($models as $model)
    <tr>
        <td>{{$model[0]->type->title}}</td>
        <td>{{$model->count()}}</td>
        <td>{{$model->sum('price')}}</td>
    </tr>
    @endforeach
</table>
<br>
@if(count($products))
    <table class="myTable" style="width:100%">
        <tr style="background-color: #a6c64c;color: white">
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{$product->product->title}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->price}}</td>
            </tr>
        @endforeach
    </table>
@endif
<br>
<table class="myTable" style="width:100%">
    <tr style="background-color: #a6c64c;color: white">
        <th>Total Price</th>
        <th>Paid Amount</th>
        <th>Remaining Amount</th>
    </tr>
    <tr>
        <td>{{$ticket->grand_total}} EGP</td>
        <td>{{$ticket->paid_amount}} EGP</td>
        <td>{{$ticket->rem_amount}} EGP</td>
    </tr>
</table>
<div class="modal-footer">
    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
        Close
    </button>
</div>

