const regiao = "Araguaína"; // definir a região
let despesasBasicas = 500; // definir as despesas básicas
let alimentacao = 600; // definir a despesa de alimentação
let transporte = 200; // definir a despesa de transporte
let lazer = 301; // definir a despesa de lazer

if (regiao === "Araguaína") {
  // calcular a renda mensal necessária para viver em Araguaína
  let rendaMensalNecessaria = despesasBasicas + alimentacao + transporte + lazer;
  
  console.log(`A renda mensal necessária em Araguaína é de R$ ${rendaMensalNecessaria}.`);
} else {
  console.log("Região inválida."); // mensagem de erro se a região não for Araguaína
}


//Os valores são apenas exemplos e podem ser alterados.
