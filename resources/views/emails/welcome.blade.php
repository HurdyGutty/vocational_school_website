@component('mail::message')
# Chào mừng bạn đến với trang web của chúng tôi

Cảm ơn bạn đã đăng ký làm {{$is_teacher?"giáo viên":"học sinh";}} của trang web của chúng tôi.
{{$is_teacher?"Bạn cần phải chờ một tuần để xác nhận tài khoản giáo viên của bạn.":""}}

@component('mail::button', ['url' =>
$is_teacher
? route('index')
: route('app.auth.studentVerification',[ 'user_id' => $user_id])
])
Xác thực
@endcomponent

Xin cảm ơn,<br>
{{ config('app.name') }}
@endcomponent