/*let tentativas = 0; // Contador de tentativas
const maxTentativas = 3; // Máximo de tentativas permitidas

// Simula credenciais corretas (troque conforme necessário)
const usuarioCorreto = "teste@gmail.com";
const senhaCorreta = "12345";

// Função para validar o login
function validarLogin() {
    // Obtém os valores dos campos
    const username = document.getElementById("typeEmailX-2").value;
    const password = document.getElementById("senha").value;

    // Verifica se as credenciais estão corretas
    if (username === usuarioCorreto && password === senhaCorreta) {
        alert("Login bem-sucedido!"); 
        window.location.href = "PerfilPrestador.html"; // Redireciona após sucesso
    } else {
        tentativas++; // Incrementa tentativas
        if (tentativas >= maxTentativas) {
            alert("Você errou a senha 3 vezes. Sua conta está temporariamente bloqueada.\nPor favor, resete sua senha.");
            document.getElementById("typeEmailX-2").disabled = true;
            document.getElementById("senha").disabled = true;
            document.querySelector("button").disabled = true;
        } else {
            const restantes = maxTentativas - tentativas;
            alert(`Usuário ou senha incorretos.\nVocê tem mais ${restantes} tentativa(s).`);
        }
    }
} */

// Adiciona um evento ao botão de login
document.addEventListener("DOMContentLoaded", function() {
    const botaoLogin = document.querySelector("button");
    botaoLogin.addEventListener("click", validarLogin);
});
document.getElementById("telefone").addEventListener("input", function (e) {
    let input = e.target.value.replace(/\D/g, ""); // Remove tudo que não for número
    if (input.length > 10) {
        // Formato (99) 99999-9999
        input = input.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else {
        // Formato (99) 9999-9999
        input = input.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    }
    e.target.value = input;
});
