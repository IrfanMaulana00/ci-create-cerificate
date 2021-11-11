<html><head>
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                font-family: Georgia, serif;
                font-size: 24px;
                text-align: center;
            }
            .container {
                border: 20px solid tan;
                height: 600px;
                padding-top: 18%;
                vertical-align: middle;
            }
            .logo {
                color: tan;
            }

            .marquee {
                color: tan;
                font-size: 48px;
                margin: 20px;
            }
            .assignment {
                margin: 20px;
            }
            .person {
                border-bottom: 2px solid black;
                font-size: 32px;
                font-style: italic;
                margin: 20px auto;
                width: 600px;
            }
            .reason {
                margin: 20px;
            }
            .tanggal {
                margin: 20px;
                font-size: 20px;
            }
        </style>
        <title>Sertifikat - <?= ((isset($peserta)) ? $peserta->nama : ''); ?></title>
    </head><body>
        <div class="container">
            <div class="logo">
                An Organization
            </div>

            <div class="marquee">
                Certificate of Completion
            </div>

            <div class="assignment">
                This certificate is presented to
            </div>

            <div class="person">
                <?= ((isset($peserta)) ? $peserta->nama : ''); ?>
            </div>

            <div class="reason">
              <?= ((isset($pelatihan)) ? ucwords($pelatihan->judul) : ''); ?>
            </div>

            <div class="tanggal">
              Pada Tanggal <?= ((isset($pelatihan)) ? ucwords($pelatihan->tanggal) : ''); ?>
            </div>
        </div>
    </body></html>