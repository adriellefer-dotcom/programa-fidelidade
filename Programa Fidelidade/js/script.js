const formulario = document.getElementById("cadastroForm");

if(formulario){

    formulario.addEventListener("submit", function(event){

        const nome = document.getElementById("nome").value;
        const cpf = document.getElementById("cpf").value;
        const telefone = document.getElementById("telefone").value;
        const email = document.getElementById("email").value;
        const cidade = document.getElementById("cidade").value;
        const aceite = document.getElementById("aceite").checked;

        if(
            nome === "" ||
            cpf === "" ||
            telefone === "" ||
            email === "" ||
            cidade === ""
        ){
            alert("Preencha todos os campos.");
            event.preventDefault();
            return;
        }

        if(cpf.length < 11){
            alert("CPF inválido.");
            event.preventDefault();
            return;
        }

        if(!aceite){
            alert("Você deve aceitar participar do programa.");
            event.preventDefault();
        }

    });

}