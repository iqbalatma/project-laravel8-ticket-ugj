<!DOCTYPE html>
<html>

<head>
  <title>Laravel 8 Send Email Example</title>
</head>

<body>

  <div class="container mt-4">
    <p>haha</p>


    @foreach ($tickets as $ticket)
    <?php 
     $qrcode=QrCode::generate("http://localhost:8000/ticket/code/".$ticket->code);
     $qrcode=str_replace('<?xml version="1.0" encoding="UTF-8"?>',"",$qrcode);
    ?>
    {!! $qrcode !!}

    <br>
    <hr>
    @endforeach
  </div>
</body>

</html>