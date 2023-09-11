<!DOCTYPE html>
<html>
<head>
    <title>QR Codes</title>
</head>
<body>
    @foreach ($qrCodesArray as $qrCodeData)
    <div>
        <p>Key: {{ $qrCodeData['value'] }}</p>
        
    </div>
    @endforeach
</body>
</html>




