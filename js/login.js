var modal_1 = document.getElementById("solicitar_troca");
var openModalBtn_1 = document.getElementById("modal_Solicita_senha");
var closeModalBtn_1 = document.getElementById("closeModalBtn_1");

openModalBtn_1.onclick = function() {
    modal_1.style.display = "block";
};

closeModalBtn_1.onclick = function(){
    modal_1.style.display = "none";
};

window.onclick = function(event) {
    if(event.target === modal_1){
        modal_1.style.display = "none";
    }
};

var modal_2 = document.getElementById("cadastrar");
var openModalBtn_2 = document.getElementById("modal_cadastrar_user");
var closeModalBtn_2 = document.getElementById("closeModalBtn_2");

openModalBtn_2.onclick = function() {
    modal_2.style.display = "block";
};

closeModalBtn_2.onclick = function(){
    modal_2.style.display = "none";
};

