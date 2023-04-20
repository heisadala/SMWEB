function Update() 
{
  if (document.getElementById("primaryKey").innerHTML == 'primaryKey') {
      alert("NOTHING SELECTED")
  }
  else {
	  var reference=document.getElementById("primaryKey").innerHTML
	  var language=document.getElementById("language").innerHTML
	  var originSite=document.getElementById("originSite").innerHTML
      console.log(reference)
      console.log(originSite + "/public/Update_form.php?Ref=" + reference)
      window.open(originSite + '/public/Update_form.php?lang=' + language + '&Ref=' + reference, '_blank').focus;
 }
}
function Delete() 
{
  if (document.getElementById("primaryKey").innerHTML == 'primaryKey') {
      alert("NOTHING SELECTED")
  }
  else {
	  var reference=document.getElementById("primaryKey").innerHTML
    var name=document.getElementById("primaryKeyName").innerHTML;

	  // var language=document.getElementById("language").innerHTML
	  // var originSite=document.getElementById("originSite").innerHTML
    console.log("***" + reference + '****');
    console.log("***" + name + '****');
    // console.log(originSite + "/public/Delete_form.php?Ref=" + reference)
      // window.open(originSite + '/public/Delete_form.php?lang=' + language + '&Ref=' + reference, '_blank').focus;
      console.log("https://www.smweblou.fr/DEV_SMWEB/public/DB/LEGO/DELETE/" + name + '/' + reference)
      window.open("https://www.smweblou.fr/DEV_SMWEB/public/DB/LEGO/DELETE/" + name + '/' + reference, '_blank').focus;
  }
}

