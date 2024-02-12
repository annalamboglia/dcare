/* Script per visualizzare il nome dell'immagine caricata */
var inputImage = document.getElementById("inputImage");
var imageText = document.getElementById("imageText");
inputImage.addEventListener('change', inputImageListener);

function inputImageListener(event) {

    var input = event.srcElement;
    var fileName = input.files[0].name;
    imageText.textContent = fileName;

}