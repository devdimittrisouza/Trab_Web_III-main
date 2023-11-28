"use strict";

const preencherFormulario = (endereco) => {
  document.getElementById("logra").value = endereco.logradouro;
  document.getElementById("cidade").value = endereco.localidade;
  document.getElementById("bairro").value = endereco.bairro;
};

const cepValido = (cep) => cep.length == 8;

const pesquisarCep = async () => {
  const cep = document.getElementById("cep").value;
  const url = `http://viacep.com.br/ws/${cep}/json/`;
  if (cepValido(cep)) {
    const dados = await fetch(url);
    const endereco = await dados.json();
    if (endereco.hasOwnProperty("erro")) {
      document.getElementById("logra").value = "CEP não encontrado";
    }else {
      preencherFormulario(endereco);
    }
  }else{
    document.getElementById("logra").value = "CEP fora dos padrões corretos.";
  }
  //fetch(url).then(response => response.json()).then(console.log);
  //console.log(cep);
};

document.getElementById("cep").addEventListener("focusout", pesquisarCep);
