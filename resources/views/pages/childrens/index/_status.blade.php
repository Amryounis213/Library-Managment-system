<!--begin::Status--->
@php
    if($model->ClassPlacement){
    $result = 'مسكن الان';
    $class = 'badge-light-success';

}
else{
    $result ='غير مسكن';
    $class = 'badge-light-danger';
}
@endphp

<div class="badge {{$class}}">{{$result}}</div>
{{-- 
// if ($model->cancel == 1) {
//     $result = 'ملغي';
//     $class = 'badge-light-danger';
// } else
// if ($model->status == 2) {
//     $result = __('Check done');
//     $class = 'badge-light-info';
// } else if ($model->status == 3) {
//     if (auth()->user()->role_id == 10 && $model->pharmacy_payment == 0) {
//         $result = __('Ready to pay');
//         $class = 'badge-light-danger';
//     } else if (auth()->user()->role_id == 12 && $model->lab_payment == 0) {
//         $result = __('Ready to pay');
//         $class = 'badge-light-danger';
//     } else if (auth()->user()->role_id == 13 && $model->xray_payment == 0) {
//         $result = __('Ready to pay');
//         $class = 'badge-light-danger';
//     } else {
//         $result = __('Check done');
//         $class = 'badge-light-info';
//     }
// } else if ($model->status > 3) {
//     if (auth()->user()->role_id == 10 && $model->pharmacy_payment > 0) {
//         $result = __('paid');
//         $class = 'badge-light-success';
//     } else if (auth()->user()->role_id == 12 && $model->lab_payment > 0) {
//         $result = __('paid');
//         $class = 'badge-light-success';
//     } else if (auth()->user()->role_id == 13 && $model->xray_payment > 0) {
//         $result = __('paid');
//         $class = 'badge-light-success';
//     } else {
//         $result = __('Check done');
//         $class = 'badge-light-info';
//     }
// }
//  --}}
<!--end::Status--->
