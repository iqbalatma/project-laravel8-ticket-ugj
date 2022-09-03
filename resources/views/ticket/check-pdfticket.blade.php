<!DOCTYPE html>
<html>

<head>
  <title>TICKET FIESTA</title>
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
      border-style: solid;
      border-color: rgb(255, 255, 255);
      border-width: 0.07rem;

      /* position: absolute; */
    }

    .qr-code {
      z-index: 10;
      right: 100px;
      float: right;
      margin-top: -13rem;
      margin-right: 1rem;
      height: 6rem;
      width: 6rem;
      border-style: solid;
      border-color: rgb(255, 255, 255);
      border-width: 0.1rem;
    }
  </style>
</head>

<body>
  @php
  $qrCode=QrCode::format('png')->size(512)->generate("TOKTOKTO");
  $qrCode = base64_encode($qrCode);
  $ticket = base64_encode(file_get_contents(public_path("/ticket/BASE_TICKET_PRESALE2.webp")));
  @endphp
  <div class="ticket-container">
    @php
    echo "<img src='data:image/png;base64," . $ticket . "' class='ticket'>";
    echo "<img src='data:image/png;base64," . $qrCode . "' class='qr-code'>";
    @endphp
  </div>
</body>

</html>