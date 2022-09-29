@component('mail::message')
# Thay đổi về lớp {{$class_name}}

Lớp {{$class_name}} {{
    switch ($status) {
        case 0:
            return "đang chờ duyệt. Bạn hãy chờ khoảng 2 tuần.";
            break;
        case 1:
            return "vẫn chưa đủ số lượng sinh viên. Bạn cần phải chờ thêm 2 tuần.";
            break;
        case 2:
            return "đã mở. Bạn có thể vào lớp.";
            break;
        case 3:
            return "đã kết thúc.";
            break;
        case 4:
            return "đã huỷ vì không đủ sinh viên. Bạn hãy liên hệ với nhân viên tư vấn để có thể đăng ký lớp khác.";
            break;
        default:
            return "đã bị lỗi. Bạn hãy liên hệ với nhân viên tư vấn.";
    }
}} <br>

Xin cảm ơn,<br>
{{ config('app.name') }}
@endcomponent