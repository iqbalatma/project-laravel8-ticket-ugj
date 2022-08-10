<!DOCTYPE html>
<html>

<head>
  <title>Laravel 8 Send Email Example</title>
  <style>
    html,
    body,
    div,
    span,
    applet,
    object,
    iframe,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    blockquote,
    pre,
    a,
    abbr,
    acronym,
    address,
    big,
    cite,
    code,
    del,
    dfn,
    em,
    img,
    ins,
    kbd,
    q,
    s,
    samp,
    small,
    strike,
    strong,
    sub,
    sup,
    tt,
    var,
    b,
    u,
    i,
    center,
    dl,
    dt,
    dd,
    ol,
    ul,
    li,
    fieldset,
    form,
    label,
    legend,
    table,
    caption,
    tbody,
    tfoot,
    thead,
    tr,
    th,
    td,
    article,
    aside,
    canvas,
    details,
    embed,
    figure,
    figcaption,
    footer,
    header,
    hgroup,
    menu,
    nav,
    output,
    ruby,
    section,
    summary,
    time,
    mark,
    audio,
    video {
      margin: 0;
      padding: 0;
      border: 0;
      font-size: 100%;
      font: inherit;
      vertical-align: baseline;
    }

    /* HTML5 display-role reset for older browsers */
    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
      display: block;
    }

    body {
      line-height: 1;
    }

    ol,
    ul {
      list-style: none;
    }

    blockquote,
    q {
      quotes: none;
    }

    blockquote:before,
    blockquote:after,
    q:before,
    q:after {
      content: "";
      content: none;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    /* mycss */

    /* class : ticket-container , ticket , qr-code */

    .ticket-container {
      position: relative;
      background-color: black;
      width: max-content;
    }

    .ticket {
      z-index: 5;
      width: 100%;
      margin: auto;
      /* position: absolute; */
    }

    .qr-code {
      z-index: 10;
      right: 100px;
      float: right;
      margin-top: -9rem;
      margin-right: 2rem;
      height: 5rem;
      width: 5rem;
      border-style: solid;
      border-color: #5F559C;
      border-width: 3px;
    }
  </style>
</head>

<body>
  @for ($i = 0; $i < 10; $i++) @php $qrCode=QrCode::format('png')->size(512)->generate("tes");
    $qrCode = base64_encode($qrCode);
    $ticket = base64_encode(file_get_contents(public_path("/ticket/BASE_TICKET.png")));
    @endphp
    <div class="ticket-container">
      @php
      echo "<img src='data:image/png;base64," . $ticket . "' class='ticket'>";
      echo "<img src='data:image/png;base64," . $qrCode . "' class='qr-code'>";
      @endphp
    </div>
    <br>
    <br>
    <br>
    <hr>
    @endfor


</body>

</html>