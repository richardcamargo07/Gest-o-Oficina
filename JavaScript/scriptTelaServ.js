function abrirModal() {
    const modal = document.getElementById('modalCadastro');
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

function fecharModal() {
    const modal = document.getElementById('modalCadastro');
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

window.onclick = function (event) {
    const modal = document.getElementById('modalCadastro');
    if (event.target == modal) {
        fecharModal();
    }
}

document.getElementById('formCadastroServ').addEventListener('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    fetch('../saveServ.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            if (result.includes("sucesso")) {
                alert('Serviço cadastrado com sucesso!');
                fecharModal();
                location.reload();
            } else {
                alert('Erro ao cadastrar: ' + result);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao cadastrar o serviço');
        });
});