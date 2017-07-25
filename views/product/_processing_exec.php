<script src="assets/js/processing.min.js"></script>
<script src="assets/js/processing_helper.js">
</script>
<script>

function send_capture_ajax() {
  canvas = $('#canvas0')[0].toDataURL();
  var base64Data = canvas.split(',')[1], // Data URLからBase64のデータ部分のみを取得
    data = window.atob(base64Data), // base64形式の文字列をデコード
    buff = new ArrayBuffer(data.length),
    arr = new Uint8Array(buff),
    blob, i, dataLen;

  // blobの生成
  for (i = 0, dataLen = data.length; i < dataLen; i++) {
    arr[i] = data.charCodeAt(i);
  }
  blob = new Blob([arr], { type: 'image/png' });
  send_image_binary(blob);
}

function display_capture() {
  num = 0;
  var img = new Image();
  img.src = $('#canvas' + String(num))[0].toDataURL('image/png');
  img.width = 200;
  img.height = 200;
  $('#capture_image').empty();
  $('#capture_image').append(img);

  send_capture_ajax();
}

// バイナリ化した画像をPOSTで送る関数
function send_image_binary(blob) {
  var formData = new FormData();
  formData.append('acceptImage', blob);
  formData.append('route', 'product/receive_pic');
  formData.append('id', <?php echo $_COOKIE['user_id']?>);

  $.ajax({
    type: 'POST',
    url: 'index.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (date, dataType) {
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      //console.log("error");
    }
  });
}
</script>
