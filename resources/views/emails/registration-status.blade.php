<!DOCTYPE html>
<html>
<head>
    <title>Registration Status</title>
</head>
<body>
<h1>Hello, {{ $volunteerName }}</h1>
@if($status === 'approved')
    <p>We are happy to inform you that your registration for the opportunity <strong>"{{ $oppTitle }}"</strong> has been approved.</p>
    <p>Thank you for your interest, and we look forward to working with you!</p>
@else
    <p>We regret to inform you that your registration for the opportunity <strong>"{{ $oppTitle }}"</strong> has not been approved at this time.</p>
    <p>We appreciate your effort and encourage you to apply for other opportunities in the future.</p>
@endif
<p>Thank you for your support and enthusiasm!</p>
</body>
</html>
