const parametros = new URLSearchParams(window.location.search);

const nome = parametros.get("nome");
const cpf = parametros.get("cpf");
const telefone = parametros.get("telefone");
const email = parametros.get("email");
const cidade = parametros.get("cidade");

document.getElementById("resultado").innerHTML = `
    <p><strong>Nome:</strong> ${nome}</p>
    <p><strong>CPF:</strong> ${cpf}</p>
    <p><strong>Telefone:</strong> ${telefone}</p>
    <p><strong>E-mail:</strong> ${email}</p>
    <p><strong>Cidade:</strong> ${cidade}</p>
`;