/*dblclickEdit plugin*/
function openSectionEdit(lines){
  // remove any text after #
  var location=window.location.href;
  var h=location.indexOf("#");
  if (h>0) {
    location=location.substring(0,h);
  }
  if (location.indexOf("?")<0) {
    location+="?id=start";
  }
  window.location=location+"\&do=edit";
}