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
  // $('#capture_image').replaceWith(img);
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

<form action="index.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="route" value="product/<?php echo $params['id']?>/update" /> <?php // ?route=product ?>
  <input type="hidden" name="image_name" value="<?php echo $_COOKIE['user_id']?>"> <?php // temp image file name ?>
  <div>
    <canvas id="canvas0" width="200px" height="200px">
    </canvas>
    <textarea id="source_code" name='source_code' cols="50px" rows="10">
<?php echo $params['edit_data']['source_code']?>
      </textarea>
  </div>
  <div>
    <button type="button" class="btn", onclick="run_textarea_code()">Run</button>
    <button type="button" class="btn", onclick="stop()">Stop</button>
    <input type="submit" value="submit">
  </div>
</form>

<form id='ajax_form'>
  <button type="button" class="btn", onclick="display_capture()">Capture</button>
</form>

<div id="capture_image"></div>