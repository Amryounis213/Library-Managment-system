@if(sizeof($order->xrays) > 0)
    @foreach($order->xrays as $item)
        @if($item->status == 1 && $item->payment_status == 2)
            <tr class="fw-bolder text-gray-700 fs-5 text-end">
                <td class="d-flex"><i
                        class="fa fa-genderless text-danger fs-1 me-2"></i>{{$item->xray->name}}
                </td>
                <td class=text-start">{{$item->instructions}}</td>
            </tr>
        @endif
    @endforeach
@endif

