<!DOCTYPE html><html><head><style>
.card {
  border: 4px solid blue;
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
  padding-bottom: 10px;
}

.title {
  color: grey;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

</style>
<title>Sertifikat - <?= ((isset($peserta)) ? $peserta->nama : ''); ?></title>
</head><body>

<div class="card">
  <img src="upload/img_avatar2.png" style="width:100%">
  <h2><?= ((isset($peserta)) ? $peserta->nama : ''); ?></h2>
  <p class="title"><?= ((isset($peserta)) ? $peserta->bisnis : ''); ?></p>
  <p><?= ((isset($peserta)) ? $peserta->nomor : ''); ?></p>
  <p><?= ((isset($peserta)) ? $peserta->email : ''); ?></p>
</div></body></html> 