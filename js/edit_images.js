
const shadesSide = document.querySelector("#shades_side");
const shadesFront = document.querySelector("#shades_front");
const tlText = document.querySelector("#tl_text");

const joint = document.querySelector("#joint");

let array = new Array();

function drawImage(context, image, xp, yp, stickerWidth, stickerHeight)
{
    if (!image.complete)
    {
        setTimeout(function()
        {
            drawImage(context, image, xp, yp, stickerWidth, stickerHeight);
        }, 50);
        return ;
    }
    context.drawImage(image, xp, yp, stickerWidth, stickerHeight);
}

joint.addEventListener('click', function stick()
{
    const context = canvas.getContext('2d');
    var image = new Image();
    image.src = 'stickers/joint.png';
    drawImage(context, image, 210, 290, 90, 90);
    if (!array.includes('joint'))
        array.push('joint');
})

shadesFront.addEventListener('click', function stick()
{
    const context = canvas.getContext('2d');
    var image = new Image();
    image.src = 'stickers/shades_front.png';
    drawImage(context, image, 230, 140, 170, 170);
    if (!array.includes('shades'))
        array.push('shades');
})

tlText.addEventListener('click', function stick()
{
    const context = canvas.getContext('2d');
    var image = new Image();
    image.src = 'stickers/thug_life_text.png';
    drawImage(context, image, 20, 10, 200, 200);
    if (!array.includes('text'))    
        array.push('text');
})
