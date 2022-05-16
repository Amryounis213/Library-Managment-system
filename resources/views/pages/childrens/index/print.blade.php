<div style="height: 370px">
    <div style="text-align: right; padding: 20px">
        <span>الاسم:</span>
        <span style="font-weight: bold;">{{$order->name}}</span>
        <br><br>
        <span>العيادة:</span>
        <span style="font-weight: bold;">{{$order->clinic->name}}</span>
        <br><br>
        <span>الطبيب:</span>
        <span style="font-weight: bold;">{{$order->doctor->name}}</span>
    </div>
    <div style="text-align: center; padding: 20px">
        <span style="font-weight: bold; font-size: 30px"> # </span>
        <span style="font-weight: bold; font-size: 50px">{{$order->no}}</span>
    </div>
    <div style="text-align: right; padding: 20px">
        <span style="font-weight: bold; font-size: 12px;">{{\Carbon\Carbon::parse($order->created_at)->dayName}}</span>
        <br>
        <span
            style="font-weight: bold; font-size: 12px; direction: ltr">{{date('H:m A', strtotime($order->created_at))}}</span>
        ***
        <span style="font-weight: bold; font-size: 12px;">{{date('d-m-Y', strtotime($order->created_at))}}</span>
    </div>
</div>

<!-- begin::Footer-->
<div style="text-align: right; padding: 20px" id="printPageButton">
    <button type="button" class="btn btn-success w-100px m-1" onclick="window.print();">
        طباعة
    </button>
    <!-- end::Action-->
</div>
<!-- end::Footer-->
{{--/////////////////////////////// - CSS - ///////////////////////////////--}}
<style>
    @media print {
        #printPageButton {
            display: none;
        }

        /*@page {*/
        /*    size: a5;*/
        /*}*/
    }
</style>
