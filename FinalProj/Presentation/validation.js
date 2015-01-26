
function validate(){
    var valid=true;

    if(document.getElementById('fName').value == ""){
        valid = false;
    }
    if(document.getElementById('lName').value == ""){
        valid = false;
    }
    if(document.getElementById('uName').value == "" || document.getElementById('uName').value.length < 8){
        valid = false;
    }
    if(document.getElementById('pwd').value == ""){
        valid = false;
    }

    return valid;


}

function validateWebPage()
{
    var valid = true;

    //Validating 'addname' textbox...
    if(document.getElementById("name").value == "" || document.getElementById("name").value == null || document.getElementById("name").value.length > 45)
    {
        valid = false;
    }
    var rx = /^\S+$/;

    if(document.getElementById("alias").value.match(rx) == false || document.getElementById("alias").value == "" || document.getElementById("alias").value == null || document.getElementById("alias").value.length > 45)
    {
        valid = false;
    }

    return valid;
}

function validateArticle(){

    var valid = true;
    var rx = /^\d*$/;
    if(document.getElementById('name').value == ""){
        valid = false;
    }
    if(document.getElementById('title').value == ""){
        valid = false;
    }
    if(document.getElementById('html').value == ""){
        valid = false;
    }
    if(document.getElementById('page').value == "" || document.getElementById('page').value.match(rx) == false){
        valid = false;
    }
    if(document.getElementById('area').value == "" || document.getElementById('area').value.match(rx) == false){
        valid = false;
    }

    return valid;
}

function validateContentArea(){
    var valid = true;
    var rx = /^\S+$/;
    var rxN = /^\d*$/;

    if(document.getElementById('name').value == ""){
        valid = false;
    }
    if(document.getElementById("alias").value.match(rx) == false || document.getElementById("alias").value == "" || document.getElementById("alias").value == null || document.getElementById("alias").value.length > 45)
    {
        valid = false;
    }
    if(document.getElementById('order').value == "" || document.getElementById('order').value.match(rxN) == false){
        valid = false;
    }



    return valid;
}

function validateCSS(){

    var valid = true;
    var rx = /^\d*$/;

    if(document.getElementById('name').value == ""){
        valid = false;
    }
    if(document.getElementById('state').value != '1' && document.getElementById('state').value != '0'){
        valid = false;
    }
    if(document.getElementById('css').value == ""){
        valid = false;
    }

    return valid;
}

function validateWebPageDelete()
{
    var valid = true;
    if(document.getElementbyId('id').value == "" || document.getElementbyId('id').value == null)
    {
        valid = false;
    }
    return valid;
}

function validateContentDelete()
{
    var valid = true;
    if(document.getElementbyId('did').value == "" || document.getElementbyId('did').value == null)
    {
        valid = false;
    }
    return valid;
}