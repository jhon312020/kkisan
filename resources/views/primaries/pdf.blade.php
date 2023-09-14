<!DOCTYPE html>
<html>
  <head>
    <title>QR Codes</title>
  </head>
  <body>  
    @foreach ($qrCodesArray as $qrCodeData)  
    <div>   
      <?php   
        $svg = file_get_contents($qrCodeData["qrCode"]);   
        echo $html = '<img src="data:image/svg+xml;base64,'.base64_encode($svg). '" width="50" height="50" />';   
      ?>  
      <span>{{ $qrCodeData['value'] }} </span>
    </div>  
    @endforeach
  </body>
</html>