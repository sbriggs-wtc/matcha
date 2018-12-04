
function displayImgInputDiv(value)
{
    imgInputDiv.style.display = value;
}

function displayPhotoDiv(value)
{
    photoDiv.style.display = value;
    canvas.style.display = "block";
}

let width = 600,
    height = 0,
    streaming = false;

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const canvasog = document.getElementById('canvas-hold');
const photos = document.getElementById('photos');
const photoButton = document.getElementById('photo-button');
const imgForm = document.getElementById('img-form');
const photoDiv = document.getElementById('photo-div');
const imgInputDiv = document.getElementById('div-img-src');
const submitImgButton = document.getElementById('id-submit-img');
const deleteImgButton = document.getElementById('id-delete-img');
const preexImg = document.getElementById('input-img-preex');
const preexSubmit =  document.getElementById('submit-preex');
const img = document.getElementById('img');

navigator.mediaDevices.getUserMedia({video: true, audio: false})
.then(function(stream)
{
    video.srcObject = stream;
    video.play();
})
.catch(function(err)
{
    console.log(`Error: ${err}`);
});
video.addEventListener('canplay', function(e)
{
    if (!streaming)
    {
        height = video.videoHeight / (video.videoWidth / width);
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
    }
}, false);

photoButton.addEventListener('click', function(e)
{
    takePicture();
    e.preventDefault();
    displayImgInputDiv("none");
    displayPhotoDiv("block");
    canvasog.style.display = "none";
});

deleteImgButton.addEventListener('click', function()
{
    array = new Array();
    displayImgInputDiv("block");
    displayPhotoDiv("none");
    preexImg.value = "";
});

submitImgButton.addEventListener('click', function save()
{
    console.log("submit image");
    xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/imghandle.inc.php');
    xhr.addEventListener('load', function (event){
        window.location = "upload_img.php";
        preexImg.value = "";
        array = new Array();
    });
    xhr.addEventListener('load', function (event){alert(this.response);});
    xhr.addEventListener('error', function (event){alert(this.response);});
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send("file="+canvasog.toDataURL() + "&options=" + array);
    displayImgInputDiv("block");
    displayPhotoDiv("none");
});

function takePicture()
{ 
    const context = canvas.getContext('2d');
    const context2 = canvasog.getContext('2d');
    if (width && height)
    {
        canvas.width = width;
        canvas.height = height;
        context.drawImage(video, 0, 0, width, height);
        canvasog.width = width;
        canvasog.height = height;
        context2.drawImage(video, 0, 0, width, height);
    }
}

preexImg.addEventListener("change", (e) => loadtocanvas(e.target.files));
function loadtocanvas(e)
{
    var file = null;
    for (let i = 0; i < e.length; i++)
    {
        if (e[i].type.match(/^image\//))
        {
            file = e[i];
            break;
        }
    }
    var newimg = new Image();
    if (file)
    {
        newimg.onload = function()
        {
            displayImgInputDiv("none");
            displayPhotoDiv("block");
            canvas.style.display = "block";
            canvas.width = this.width;
            canvasog.width = this.width;
            canvas.height = this.height;
            canvasog.height = this.height;
            canvas.getContext('2d').drawImage(newimg, 0, 0);
            canvasog.getContext('2d').drawImage(newimg, 0, 0);
        }
        newimg.src = URL.createObjectURL(file);
    }
}
