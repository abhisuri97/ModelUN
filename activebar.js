
       
var selectionCount = document.querySelectorAll("#menulist > li").length;
for (i = 0; i < selectionCount; i++)
{
    
    var current = $('#menulist > li')[i];
    console.log(current.dataset.url);
    if(window.location.href.indexOf(current.dataset.url) > -1) {
       current.className=" active";
     }
    if(window.location.href.indexOf(current.dataset.url2) > -1) {
       current.className=" active";
     }
}
