
function saveComment(clicked_id, ownername)
{
    var text = document.getElementById(clicked_id.toString());
    xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/comment_handle.inc.php');
    xhr.addEventListener('load', function (event){alert(this.response);text.value=""; var url = "gallery.php"; window.location = url;});
    xhr.addEventListener('error', function (event){alert(this.response);});
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(   "imgid="+clicked_id+
                "&imgowner="+ownername+
                "&submit=1"+
                "&text="+text.value);
}

function like(clicked_id)
{
    xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/like_handle.inc.php');
    xhr.addEventListener('load', function (event){alert(this.response);});
    xhr.addEventListener('error', function (event){alert(this.response);});
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(   "imgid="+clicked_id+
                "&submit=1");
}

function delImg(clicked_id)
{
    xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/img_del_handle.inc.php');
    xhr.addEventListener('load', function (event){
        var url = "gallery.php"; //change from gallery to upload
        window.location = url;
    });
    xhr.addEventListener('error', function (event){alert(this.response);});
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(   "imgid="+clicked_id+
                "&submit=1");
}