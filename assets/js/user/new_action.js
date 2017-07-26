

// var shaObj = new jsSHA('password', "ASCII");
// var sha256digest = shaObj.getHash("SHA-256", "HEX");

var str = "hogepiyo";
var hashedstr = (new jsSHA(str, 'ASCII')).getHash('SHA-512', 'HEX');

$('#hash_action').click(function () {
  // $('#hash_area').append(sha256digest);
  alert(hashedstr);
});