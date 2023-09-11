<!DOCTYPE html>
<html>
<head>
    <title>QR Codes</title>
</head>
<body>
    @foreach ($qrCodesArray as $qrCodeData)
    <div>
        <?php  $svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 36 36" class="circular-chart">    <path class="circle-bg"          stroke-width="1"          fill="none"          stroke="#ddd"          d="M18 2.0845             a 15.9155 15.9155 0 0 1 0 31.831             a 15.9155 15.9155 0 0 1 0 -31.831"          /></svg>'; 
          echo $html = '<img src="data:image/svg+xml;base64,'.base64_encode($svg).'"  width="100" height="100" />'; ?> {{ $qrCodeData['value'] }}
    </div>
    @endforeach
</body>
</html>




