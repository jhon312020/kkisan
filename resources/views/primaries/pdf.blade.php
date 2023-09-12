<!DOCTYPE html>
<html>
  <head>
    <title>QR Codes</title>
  </head>
  <body>  
    @foreach ($qrCodesArray as $qrCodeData)  
    <div>   
      <p>Key: {{ $qrCodeData['value'] }}</p>   
      <?php   
        $svg = file_get_contents($qrCodeData["qrCode"]);   
        echo $html = '<img src="data:image/svg+xml;base64,'.base64_encode($svg). '" width="100" height="100" />';   
      ?>  
    </div>  
    @endforeach
  </body>
</html>