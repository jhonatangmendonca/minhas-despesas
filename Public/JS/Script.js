 // função que mostra o mes e a data no cabecalho
 $(document).ready(function fnMostraMesData() {
     var mes = $('#mesDespesa').val();
     var ano = $('#anoDespesa').val();
     monName = new Array(
         '',
         'Janeiro',
         'Fevereiro',
         'Março',
         'Abril',
         'Maio',
         'Junho',
         'Julho',
         'Agosto',
         'Setembro',
         'Outubro',
         'Novembro',
         'Dezembro'
     );
     var localdate = monName[mes] + ' / ' + ano;
     $('#LabelMesAnoCorrente').val(localdate);
 });

 // ativa outras opções
 function fnAtivaParcelamento() {
     if (document.getElementById('IdFixo').disabled === true) {
         document.getElementById('IdFixo').disabled = false;
         document.getElementById('repetirDespesas').removeAttribute('class');
         document.getElementById('IdParcelado').disabled = false;
     } else {
         document
             .getElementById('repetirDespesas')
             .setAttribute('class', 'item-hide');
         document.getElementById('IdFixo').disabled = true;
         document.getElementById('IdParcelado').disabled = true;
         document.getElementById('IdQntParcelas').disabled = true;
     }
 }
 // ativa repetir parcelado
 function fnAtivaRepetirParcelado() {
     if (document.getElementById('IdParceladoFixo').checked == true) {
         document.getElementById('IdQntParcelasFixas').disabled = false;
         document.getElementById('IdQntParcelas').disabled = true;
         document.getElementById('IdQntParcelas').value = '';
         $('#InputParcelas2').addClass('item-hide');
         $('#InputParcelas').removeClass('item-hide');
     }
 }

 // ativa parcelar a despesa
 function fnAtivaQuantidadeParcelas() {
     if (document.getElementById('IdParcelado').checked == true) {
         document.getElementById('IdQntParcelas').disabled = false;
         document.getElementById('IdQntParcelasFixas').disabled = true;
         document.getElementById('IdQntParcelasFixas').value = '';
         $('#InputParcelas').addClass('item-hide');
         $('#InputParcelas2').removeClass('item-hide');
     }
 }

 // desativa a quantidade de parcelas
 function fnDesativaQuantidadeParcelas() {
     if (document.getElementById('IdFixo').checked == true) {
         document.getElementById('IdQntParcelas').disabled = true;
         document.getElementById('IdQntParcelasFixas').disabled = true;
         document.getElementById('IdQntParcelasFixas').value = '';
         document.getElementById('IdQntParcelas').value = '';
         $('#InputParcelas').addClass('item-hide');
         $('#InputParcelas2').addClass('item-hide');
     }
 }

 // habilita os campos de edição do detalhamento
 function fnAbreEditar() {
     if ($('#BntSalvar').hasClass('item-hide')) {
         $('#Descricao').removeAttr('disabled');
         $('#Data').removeAttr('disabled');
         $('#Observacao').removeAttr('disabled');
         $('#Valor').removeAttr('disabled');
         $('#Cor').removeAttr('disabled');
         $('#BntSalvar').removeClass('item-hide');
         $('#DivStatus').removeClass('item-hide');
         $('#BntExcluir').addClass('item-hide');
         $('#LabelStatusDespesa').addClass('item-hide');
         $('#DivBntPagamento').addClass('item-hide');
         $('#BntSalvar').addClass('mt-0');
         document.getElementById('FormDetalhamento').action =
             'ProcessaEdicaoDespesa.php';
     } else {
         $('#BntSalvar').addClass('item-hide');
         $('#DivStatus').addClass('item-hide');
         $('#BntExcluir').removeClass('item-hide');
         $('#Descricao').attr('disabled', '');
         $('#Cor').attr('disabled', '');
         $('#Valor').attr('disabled', '');
         $('#Data').attr('disabled', '');
         $('#Observacao').attr('disabled', '');
         $('#LabelStatusDespesa').removeClass('item-hide');
         $('#DivBntPagamento').removeClass('item-hide');
         document.getElementById('FormDetalhamento').action =
             'ProcessaExclusaoDespesa.php';
     }
 }

 // função com confirmação de exclusao
 function fnConfirmExcluirDespesa(PkDespesa, DespesaFixa, DespesaParcelada) {
     if ((DespesaFixa === 'Não') && (DespesaParcelada === 'Não')) {
         Swal.fire({
             title: 'Excluir despesa?',
             text: 'Você não poderá reverter isso!!',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Sim, excluir!',
             cancelButtonText: 'Cancelar',
         }).then((result) => {
             if (result.value) {
                 window.location.href = `Excluir.php?PkDespesa=${PkDespesa}&Parcelado=Nao&DespesaFixa=Nao&ExcluiTodas=Nao`;
             }
         });
     } else if ((DespesaFixa === 'Não') && (DespesaParcelada === 'Sim')) {
         Swal.fire({
             title: 'Excluir Despesa!',
             text: 'Esta é uma despesa parcelada. Quais excluir?',
             icon: 'question',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#3085d6',
             confirmButtonText: 'Somente Esta',
             cancelButtonText: 'Todas Existentes',
         }).then((result) => {
             if (result.value) {
                 window.location.href = `Excluir.php?PkDespesa=${PkDespesa}&Parcelado=Sim&DespesaFixa=Nao&ExcluiTodas=Nao`;
             } else if (result.dismiss == 'cancel') {
                 window.location.href = `Excluir.php?PkDespesa=${PkDespesa}&Parcelado=Sim&DespesaFixa=Nao&ExcluiTodas=Sim`;
             }
         });
     } else {
         Swal.fire({
             title: 'Excluir Despesa!',
             text: 'Esta é uma despesa fixa. Quais excluir?',
             icon: 'question',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#3085d6',
             confirmButtonText: 'Somente Esta',
             cancelButtonText: 'Todas Existentes',
         }).then((result) => {
             if (result.value) {
                 window.location.href = `Excluir.php?PkDespesa=${PkDespesa}&Parcelado=Nao&DespesaFixa=Sim&ExcluiTodas=Nao`;
             } else if (result.dismiss == 'cancel') {
                 window.location.href = `Excluir.php?PkDespesa=${PkDespesa}&Parcelado=Nao&DespesaFixa=Sim&ExcluiTodas=Sim`;
             }
         });
     }
 }

 // alert com confirmação de exclusao
 function fnProcessaEdicao(aux) {
     if (aux === 'Rendimento') {
         document.FormDetalhamento.action = 'ProcessaEdicaoRendimento.php';
         document.FormDetalhamento.submit();
     } else if (aux === 'RendimentoFixo') {
         document.FormDetalhamento.action = 'ProcessaEdicaoRendimentoFixo.php';
         document.FormDetalhamento.submit();
     } else {
         document.FormDetalhamento.action = 'ProcessaDespesa.php';
         document.FormDetalhamento.submit();
     }
 }

 // função que redireciona para o form que irá subtrair ou somar meses
 function reload(type) {
     const aux = type;
     if (aux === 'subtrair') {
         window.location = 'AlternaMes.php?status=sub';
     } else if (aux === 'somar') {
         window.location = 'AlternaMes.php?status=sum';
     } else {
         window.location = 'AlternaMes.php?status=corrente';
     }
 }

 // função que confirma saída do sistema
 function fnFazLogout() {
     Swal.fire({
         title: 'Deseja sair do sistema?',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Sim, sair!',
         cancelButtonText: 'Não, ficar',
     }).then((result) => {
         if (result.value) {
             window.location.href = './../Login/logout.php';
         }
     });
 }

 // função que confirma saída do sistema
 function fnFazLogoutDash() {
     Swal.fire({
         title: 'Deseja sair do sistema?',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Sim, sair!',
         cancelButtonText: 'Não, ficar',
     }).then((result) => {
         if (result.value) {
             window.location.href = './Login/logout.php';
         }
     });
 }
 // função com confirmação de exclusao rendimentos
 function fnExcluirRendimento(Id, tipoRendimento) {
     if (tipoRendimento === 'Rendimento') {
         Swal.fire({
             title: 'Excluir Rendimento?',
             text: 'Você não poderá reverter isso!!',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Sim, excluir!',
             cancelButtonText: 'Cancelar',
         }).then((result) => {
             if (result.value) {
                 window.location.href = 'ProcessaExclusaoRendimento.php?Id=' + Id;
             }
         });
     } else {
         Swal.fire({
             title: 'Excluir Rendimento Fixo?',
             text: 'Você não poderá reverter isso!!',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Sim, excluir!',
             cancelButtonText: 'Cancelar',
         }).then((result) => {
             if (result.value) {
                 window.location.href = 'ProcessaExclusaoRendimentoFixo.php?Id=' + Id;
             }
         });
     }
 }

 function fnExcluirLembrete(Id) {
     Swal.fire({
         title: 'Excluir Lembrete?',
         text: 'Você não poderá reverter isso!!',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Sim, excluir!',
         cancelButtonText: 'Cancelar',
     }).then((result) => {
         if (result.value) {
             window.location.href = 'ProcessaExclusaoLembrete.php?Id=' + Id;
         }
     });
 }

 function fnAbreDetalhes(value) {
     window.location.href = 'Detalhamento.php?Pk=' + value;
 }

 function fnalteraGrid(value) {
     window.location.href = `AlterarGrid.php?selectGrid=${value}`;
 }

 // habilita os campos de edição da senha (Configurações de Usuário - Senha)
 function fnAbreEditarSenha() {
     if ($('#BntSalvarSenha').hasClass('item-hide')) {
         $('#Senha').removeAttr('disabled');
         $('#BntSalvarSenha').removeClass('item-hide');
         $('#BntSalvarSenha').addClass('mt-0');
     } else {
         $('#BntSalvarSenha').addClass('item-hide');
         $('#Senha').attr('disabled', '');
     }
 }

 function fnProcessaEdicaoConfigUsuario(type) {
     const aux = type;
     if (aux === 2) {
         document.FormConfigUsuario.action = 'ProcessaEdicaoSenha.php';
         document.FormConfigUsuario.submit();
     }
 }

 function fnPagarEstornar(PkDespesa, PkUsuario, Tipo) {
     window.location.href = `PagarEstornar.php?PkDespesa=${PkDespesa}&PkUsuario=${PkUsuario}&Tipo=${Tipo}`;
 } // pagamento de despesa
 function fnRealizaPagamento(PkDespesa, PkUsuario, Tipo) {
     Swal.fire({
         title: 'Pagar esta despesa?',
         text: 'Marca esta despesa como paga!!',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Sim, pagar!',
         cancelButtonText: 'Cancelar',
     }).then((result) => {
         if (result.value) {
             window.location.href = `PagarEstornar.php?PkDespesa=${PkDespesa}&PkUsuario=${PkUsuario}&Tipo=${Tipo}`;
         }
     });
 }