var Pjs = new Array(1);
function stop(num) { // not work
  if (Pjs[num]) Pjs[num].exit();
}

function run_textarea_code() {
  num = 0;
  stop(num);
  var canvas = document.getElementById('canvas' + String(num));
  var code = $('#source_code').val();
  try {
    Pjs[num] = new Processing(canvas, code);
  } catch (e) {
    alert(e);
  }
}

function run_canvas_code() {
  num = 0;
  stop(num);
  var canvas = document.getElementById('canvas' + String(num));
  var code = canvas.textContent;
  try {
    Pjs[num] = new Processing(canvas, code);
  } catch (e) {
    alert(e);
  }
}