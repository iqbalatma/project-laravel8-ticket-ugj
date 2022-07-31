<h1>How to generate QR code in Laravel</h1>

<div class="container">
  <!-- generate function from simple-qr code package -->

  {{QrCode::generate('Hello!');}}

  {{ QrCode::generate('Make me into a QrCode!', '../public/qrcodes/qrcode.svg'); }}

</div>

<div class="codesource-link">
  <a href="https://https://codesource.io/">Codesource</a>
</div>