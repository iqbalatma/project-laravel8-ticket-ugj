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
      margin: auto;
    }

    .ticket {
      z-index: 5;
      visibility: invisible;
      /* position: absolute; */
    }

    .qr-code {
      z-index: 10;
      right: 200px;
      top: 50%;
      position: absolute;
      height: 10rem;
      width: 10rem;
    }
  </style>
</head>

<body>
  @foreach ($tickets as $ticket)

  <?php
    $qrcode = QrCode::generate("http://localhost:8000/ticket/code/" . $ticket->code);
    $qrcode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', "", $qrcode);
  ?>
  <figure class="ticket-container">
    <img src="/ticket/BASE_TICKET.png" alt="qrcode" srcset="" class="ticket" />
    <div class="qr-code">
      {!! $qrcode !!}
    </div>
  </figure>
  <br>
  <hr>
  @endforeach
</body>

</html>