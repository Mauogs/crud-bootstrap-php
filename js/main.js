$(document).ready(function () {
    function setDeleteModal(modalId, dataAttr, label) {
        $(modalId).on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data(dataAttr);
            var modal = $(this);
            modal.find('.modal-title').text('Excluir ' + label + ': ' + id);
            modal.find('.modal-body').text("Deseja realmente excluir este " + label.toLowerCase() + "? (" + id + ")");
            modal.find('#confirm').attr('href', 'delete.php?id=' + id);
        });
    }

    setDeleteModal('#delete-modal-cliente', 'cliente', 'Cliente');
    setDeleteModal('#delete-modal-carro', 'carro', 'Carro');
    setDeleteModal('#delete-modal-usuario', 'usuario', 'Usuário');
});

$('#cep').blur(function () {
    var vl = this.value;
    $.get('https://viacep.com.br/ws/' + vl + '/json/', function (dados) {
        $('#endereco').val(dados.logradouro);
        $('#bairro').val(dados.bairro);
        $('#cidade').val(dados.localidade);
        $('#estado').val(dados.uf);
    });
});
