//SALVAR PESSOA FISICA
$(function () {
    $("#salvarF").click(function () {
        var idfisica = document.getElementById('idfisica').value;
        var nome = document.getElementById('nome').value;
        var dt_nascimento = document.getElementById('dt_nascimento').value;
        var sexo = document.getElementById('sexo').value;
        var rg = document.getElementById('rg').value;
        var cpf = document.getElementById('cpf').value;
        var forms = document.getElementsByClassName('needs-validation');

        if (
            nome === '',
            dt_nascimento === '',
            sexo === '',
            rg === '',
            cpf === ''
        ) {
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.classList.add('was-validated');
            });
        } else {
            var request = $.ajax({
                type: 'POST',
                url: 'action/salvarFisica.php',
                dataType: 'html',
                data: {
                    idfisica: idfisica,
                    nome: nome,
                    dt_nascimento: dt_nascimento,
                    sexo: sexo,
                    rg: rg,
                    cpf: cpf,
                },
                beforeSend: function(){
                    Swal.fire('Salvando...')
                    Swal.showLoading();
                },
                success: function (data) {
                    if (data === 'sucesso') {
                        swal.fire({
                            title: "Sucesso!",
                            text: "Nova pessoa física adicionada!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Listar Registros',
                            confirmButtonColor: '#c14a40',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "index.php?op=lista&pg=pessoaFisica";
                            }
                        })
                    } else if (data === 'sucesso atualizado') {
                        swal.fire({
                            title: "Sucesso!",
                            text: "Dados atualizados!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Listar Registros',
                            confirmButtonColor: '#c14a40',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "index.php?op=lista&pg=pessoaFisica";
                            }
                        })
                    } else {
                        swal.fire(data, 'Tente novamente', 'error');
                    }
                },
                error: function (data) {
                    swal.fire('Erro no sistema', 'Contate o administrador', 'warning');
                }
            });
        }
        return false;
    });
});

//DELETER PESSOA FÍSICA
function excluirPF(id, nome) {

    swal.fire({
        title: "Tem certeza que deseja deletar " + nome,
        text: "Esta ação não pode ser desfeita e irá deletar os números e endereços!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#ccc',
        confirmButtonText: 'Deletar',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: "action/deletarFisica.php?idfisica=" + id,
                data: {
                    idfisica: id
                },
                success: function (data) {
                    if (data === 'sucesso') {
                        // console.log(data);
                        swal.fire({
                            title: "Deletado!",
                            text: "Registro deletado!",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Listar Registros',
                            cancelButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "index.php?op=lista&pg=pessoaFisica"
                            } else (
                                window.location.reload()
                            )
                        })
                    } else if (data === 'error') {
                        // console.log(data);
                        swal.fire({
                            title: "Erro ao deletar registro",
                            text: data,
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonText: 'Listar Registros',
                            cancelButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#cccccc',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "index.php?op=lista&pg=pessoaFisica";
                            }
                        })
                    } else {
                        swal.fire(data, 'Tente novamente', 'error');
                    }
                },
                error: function (data) {
                    swal.fire('Erro no sistema', 'Contate o administrador', 'warning');
                }
            });
        }
    })
}

//SALVAR NÚMERO
$(function () {
    $("#salvarN").click(function () {
        var op = document.getElementById('op').value;
        var idOp = document.getElementById('idOp').value;
        var idTelefone = document.getElementById('idTelefone').value;
        var tipoT = document.getElementById('tipoT').value;
        var numero = document.getElementById('numero').value;
        var forms = document.getElementsByClassName('needs-validation');

        if (
            tipoT === '',
            numero === ''
        ) {
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.classList.add('was-validated');
            });
        } else {
            var request = $.ajax({
                type: 'POST',
                url: 'action/salvarNumero.php',
                dataType: 'html',
                data: {
                    op: op,
                    idOp: idOp,
                    idtelefone: idTelefone,
                    tipoT: tipoT,
                    numero: numero,
                },
                beforeSend: function(){
                    Swal.fire('Salvando...')
                    Swal.showLoading();
                },
                success: function (data) {
                    if (data === 'sucesso') {
                        swal.fire({
                            title: "Sucesso!",
                            text: "Novo número adicionado!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Listar Registros',
                            confirmButtonColor: '#c14a40',
                        }).then((result) => {
                            if (result.value) {
                                window.history.back();
                            }
                        })
                    }else if (data === 'sucesso atualizado') {
                        swal.fire({
                            title: "Sucesso!",
                            text: "Dados atualizados!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Listar Registros',
                            confirmButtonColor: '#c14a40',
                        }).then((result) => {
                            if (result.value) {
                                window.history.back();
                            }
                        })
                        } else {
                        swal.fire(data, 'Tente novamente', 'error');
                    }
                },
                error: function (data) {
                    swal.fire('Erro no sistema', 'Contate o administrador', 'warning');
                }
            });
        }
        return false;
    });
});

//DELETER NÚMERO
function excluirT(id, tipoT) {

    swal.fire({
        title: "Tem certeza que deseja deletar o número do tipo " + tipoT,
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#ccc',
        confirmButtonText: 'Deletar',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: "action/deletarNumero.php?idtelefone=" + id,
                data: {
                    idtelefone: id
                },
                success: function (data) {
                    if (data === 'sucesso') {
                        // console.log(data);
                        swal.fire({
                            title: "Deletado!",
                            text: "Registro deletado!",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Listar Registros',
                            cancelButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.value) {
                                window.history.back();
                                location.reload();
                            } else (
                                window.location.reload()
                            )
                        })
                    } else if (data === 'error') {
                        // console.log(data);
                        swal.fire({
                            title: "Erro ao deletar registro",
                            text: data,
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonText: 'Listar Registros',
                            cancelButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#cccccc',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.value) {
                                window.history.back();
                                location.reload();
                            }
                        })
                    } else {
                        swal.fire(data, 'Tente novamente', 'error');
                    }
                },
                error: function (data) {
                    swal.fire('Erro no sistema', 'Contate o administrador', 'warning');
                }
            });
        }
    })
}

//SALVAR ENDEREÇO
$(function () {
    $("#salvarE").click(function () {
        var op = document.getElementById('op').value;
        var idOp = document.getElementById('idOp').value;
        var idEndereco = document.getElementById('idEndereco').value;
        var tipoE = document.getElementById('tipoE').value;
        var cep = document.getElementById('cep').value;
        var logradouro = document.getElementById('rua').value;
        var bairro = document.getElementById('bairro').value;
        var cidade = document.getElementById('cidade').value;
        var estado = document.getElementById('uf').value;
        var numero = document.getElementById('numero').value;
        var ref = document.getElementById('ref').value;
        var forms = document.getElementsByClassName('needs-validation');

        if (
            tipoE === '',
            cep === '',
            logradouro === '',
            bairro === '',
            cidade === '',
            estado === ''
        ) {
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.classList.add('was-validated');
            });
        } else {
            var request = $.ajax({
                type: 'POST',
                url: 'action/salvarEndereco.php',
                dataType: 'html',
                data: {
                    op: op,
                    idOp: idOp,
                    idendereco: idEndereco,
                    tipoE: tipoE,
                    cep: cep,
                    logradouro: logradouro,
                    bairro: bairro,
                    cidade: cidade,
                    estado: estado,
                    numero: numero,
                    ref: ref,
                },
                beforeSend: function(){
                    Swal.fire('Salvando...')
                    Swal.showLoading();
                },
                success: function (data) {
                    if (data === 'sucesso') {
                        swal.fire({
                            title: "Sucesso!",
                            text: "Novo endereço adicionado!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Listar Registros',
                            confirmButtonColor: '#c14a40',
                        }).then((result) => {
                            if (result.value) {
                                window.history.back();
                                location.reload();
                            }
                        })
                    }else if (data === 'sucesso atualizado') {
                        swal.fire({
                            title: "Sucesso!",
                            text: "Dados atualizados!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Listar Registros',
                            confirmButtonColor: '#c14a40',
                        }).then((result) => {
                            if (result.value) {
                                window.history.back();
                                location.reload();
                            }
                        })
                    } else {
                        swal.fire(data, 'Tente novamente', 'error');
                    }
                },
                error: function (data) {
                    swal.fire('Erro no sistema', 'Contate o administrador', 'warning');
                }
            });
        }
        return false;
    });
});

//DELETER ENDERECO
function excluirE(id, tipoE) {

    swal.fire({
        title: "Tem certeza que deseja deletar o número do tipo " + tipoE,
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#ccc',
        confirmButtonText: 'Deletar',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: "action/deletarEndereco.php?idendereco=" + id,
                data: {
                    idendereco: id
                },
                success: function (data) {
                    if (data === 'sucesso') {
                        // console.log(data);
                        swal.fire({
                            title: "Deletado!",
                            text: "Registro deletado!",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Listar Registros',
                            cancelButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.value) {
                                window.history.back();
                                location.reload();
                            } else (
                                window.location.reload()
                            )
                        })
                    } else if (data === 'error') {
                        // console.log(data);
                        swal.fire({
                            title: "Erro ao deletar registro",
                            text: data,
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonText: 'Listar Registros',
                            cancelButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#cccccc',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.value) {
                                window.history.back();
                                location.reload();
                            }
                        })
                    } else {
                        swal.fire(data, 'Tente novamente', 'error');
                    }
                },
                error: function (data) {
                    swal.fire('Erro no sistema', 'Contate o administrador', 'warning');
                }
            });
        }
    })
}

//SALVAR PESSOA JURIDICA
$(function () {
    $("#salvarJ").click(function () {
        var idjuridica = document.getElementById('idjuridica').value;
        var nomeFantasia = document.getElementById('nomeFantasia').value;
        var razaoSocial = document.getElementById('razaoSocial').value;
        var cnpj = document.getElementById('cnpj').value;
        var ie = document.getElementById('ie').value;
        var dt_fundacao = document.getElementById('dt_fundacao').value;
        var forms = document.getElementsByClassName('needs-validation');

        if (
            nomeFantasia === '',
            razaoSocial === '',
            cnpj === '',
            dt_fundacao === ''
        ) {
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.classList.add('was-validated');
            });
        } else {
            var request = $.ajax({
                type: 'POST',
                url: 'action/salvarJuridica.php',
                dataType: 'html',
                data: {
                    idjuridica: idjuridica,
                    nomeFantasia: nomeFantasia,
                    razaoSocial: razaoSocial,
                    cnpj: cnpj,
                    ie: ie,
                    dt_fundacao: dt_fundacao,
                },
                beforeSend: function(){
                    Swal.fire('Salvando...')
                    Swal.showLoading();
                },
                success: function (data) {
                    if (data === 'sucesso') {
                        swal.fire({
                            title: "Sucesso!",
                            text: "Nova pessoa jurídica adicionada!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Listar Registros',
                            confirmButtonColor: '#c14a40',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "index.php?op=lista&pg=pessoaJuridica";
                            }
                        })
                    } else if (data === 'sucesso atualizado') {
                        swal.fire({
                            title: "Sucesso!",
                            text: "Dados atualizados!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Listar Registros',
                            confirmButtonColor: '#c14a40',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "index.php?op=lista&pg=pessoaJuridica";
                            }
                        })
                    } else {
                        swal.fire(data, 'Tente novamente', 'error');
                    }
                },
                error: function (data) {
                    swal.fire('Erro no sistema', 'Contate o administrador', 'warning');
                }
            });
        }
        return false;
    });
});

//DELETER PESSOA FÍSICA
function excluirPJ(id, nome) {

    swal.fire({
        title: "Tem certeza que deseja deletar " + nome,
        text: "Esta ação não pode ser desfeita e irá deletar os números e endereços!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#ccc',
        confirmButtonText: 'Deletar',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: "action/deletarJuridica.php?idjuridica=" + id,
                data: {
                    idfisica: id
                },
                success: function (data) {
                    if (data === 'sucesso') {
                        // console.log(data);
                        swal.fire({
                            title: "Deletado!",
                            text: "Registro deletado!",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Listar Registros',
                            cancelButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "index.php?op=lista&pg=pessoaJuridica"
                            } else (
                                window.location.reload()
                            )
                        })
                    } else if (data === 'error') {
                        // console.log(data);
                        swal.fire({
                            title: "Erro ao deletar registro",
                            text: data,
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonText: 'Listar Registros',
                            cancelButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#cccccc',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "index.php?op=lista&pg=pessoaJuridica";
                            }
                        })
                    } else {
                        swal.fire(data, 'Tente novamente', 'error');
                    }
                },
                error: function (data) {
                    swal.fire('Erro no sistema', 'Contate o administrador', 'warning');
                }
            });
        }
    })
}