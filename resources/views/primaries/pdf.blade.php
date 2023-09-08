<!DOCTYPE html>
<html>
<head>
    <title>QR Codes</title>
</head>
<body>
    @foreach ($qrCodesArray as $qrCodeData)
    <div>
        <p>Key: {{ $qrCodeData['value'] }}</p>
        {!! QrCode::size(256)->generate($qrCodeData['qrCode']) !!}
        <img src="data:image/svg+xml;utf8,{{ rawurlencode($qrCodeData['qrCode']) }}" width="100" height="100" alt="QR Code">
    </div>
    @endforeach
</body>
</html>




