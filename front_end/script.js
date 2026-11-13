
// Busca os quartos cadastrados na API
fetch("../api/quartos.php")
    .then(resposta => resposta.json())
    .then(quartos => {

        let lista = document.getElementById("lista-quartos");

        quartos.forEach(quarto => {

            lista.innerHTML += `
                <div class="card-quarto">
                    <h3>Quarto ${quarto.numero}</h3>
                    <p>Categoria: ${quarto.categoria}</p>
                    <p>Capacidade: ${quarto.capacidade} pessoas</p>
                    <p class="preco">R$ ${Number(quarto.valor_diaria).toFixed(2)} por diária</p>
                </div>
            `;

        });

    })
    .catch(erro => {
        console.log("Erro ao buscar quartos:", erro);
    });
