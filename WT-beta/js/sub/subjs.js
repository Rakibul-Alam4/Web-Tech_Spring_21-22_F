function valname() {
  var uname = document.getElementById('username').ariaValueMax;
  uname.len
  if (uname == '') {
    document.getElementById('unameerr').innerHTML = "Name is Empty";
    return false;
  } else {
    return true;
  }
}