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
        <td>x{{$model->count()}}</td>
        <td>{{$model->sum('price')}}</td>
    </tr>
    @endforeach
</table>
<br>
<table class="myTable" style="width:100%">
    <tr style="background-color: #a6c64c;color: white">
        <th>Total Price</th>
        <th>Paid Amount</th>
        <th>Reminder Amount</th>
    </tr>
    <tr>
        <td>{{$rev->grand_total}} EGP</td>
        <td>{{$rev->paid_amount}} EGP</td>
        <td>{{$rev->rem_amount}} EGP</td>
    </tr>
</table>
<div class="modal-footer">
    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
        Close
    </button>
</div>

