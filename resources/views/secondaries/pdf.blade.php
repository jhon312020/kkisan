<!DOCTYPE html>
<html>
  <head>
    <title>QR Codes</title>
  </head>
  <body> 
    <div> 
    <?php 
      $secQRFileName = public_path("qrcodes".DIRECTORY_SEPARATOR."secondary".DIRECTORY_SEPARATOR."$secondary->id").DIRECTORY_SEPARATOR."qrcode_".$secondary->QRCode.".svg";
      $svg = file_get_contents($secQRFileName);   
      echo 's- '. $html = '<img src="data:image/svg+xml;base64,'.base64_encode($svg). '" width="50" height="50" />';   
      $primaryCodes = json_decode($secondary->SecondaryLabelDetail);
      $priFilePath = public_path("qrcodes".DIRECTORY_SEPARATOR."primary".DIRECTORY_SEPARATOR."$secondary->primary_label_id").DIRECTORY_SEPARATOR;
    ?>
    <span>{{ $secondary->QRCode  }} </span>
    </div>
    @foreach ($primaryCodes as $primaryCode)  
    <div>   
      <?php   
        $priFileName = $priFilePath. "qrcode_".$primaryCode->QRCode.".svg";
        $svg = file_get_contents($priFileName);   
        echo $html = '<img src="data:image/svg+xml;base64,'.base64_encode($svg). '" width="50" height="50" />';   
      ?>  
      <span>{{ $primaryCode->QRCode }} </span>
    </div>  
    @endforeach
  </body>
</html>