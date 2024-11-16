<!DOCTYPE html>
<html>
<head>
    <title>Registration Status</title>
</head>
<body>
    <h1>Hello, {{ $volunteerName }}</h1>
    @if($status === 'approved')
        <p>Congratulations! Your registration for the opportunity titled "{{ $oppTitle }}" has been approved.</p>
        <p>We are excited to have you on board and look forward to your participation!</p>
    @else
        <p>We are sorry to inform you that your registration for the opportunity titled "{{ $oppTitle }}" has been rejected.</p>
        <p>We appreciate your interest and encourage you to apply for other opportunities in the future.</p>
    @endif
    <p>Thank you for your enthusiasm and willingness to contribute!</p>
</body>
</html> 