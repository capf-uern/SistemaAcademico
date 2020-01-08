/**
 * Relação de functions e widgets jQuery
 */


/** ATIVANDO O MODAL BOOTSTRAP **/
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
})

$(function () {

    $( "a#encaminhar" ).click(function() {
        $("div.encaminhamento").slideToggle("slow");
    });

});

/** ATIVANDO O MODAL BOOTSTRAP **/

$(document).ready(function(){

    $('.date').mask('00/00/0000');
    $('.cep').mask('00000-000');
    $('.phone_with_ddd').mask('(00) 00000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });
    $('.ip_address').mask('099.099.099.099');
    $('.percent').mask('##0,00%', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.fallback').mask("00r00r0000", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        }
    });
    $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
});


/* EXIBIR / OCULTAR CAMPOS DOS FORMULÁRIOS DE ACORDO COM A OPTION SELECIONADA */

$(document).ready(function() {

    $("#demais_profissionais").hide();

    $('#selector').change(function() {
        if ($(this).val() === "5") {
            $("#demais_profissionais").show();
        }
        else{
            $("#demais_profissionais").hide();
        }
    });

    $('#selector').change(function() {
        if ($(this).val() === "1") {
            $("#profissao").val('Professor Universitário');
            $("#inputfile").removeAttr("required");
            $("#rowfile").hide();
        }else if ($(this).val() === "2") {
            $("#profissao").val('Aluno de Pós-Graduação');
            $("#inputfile").attr("required");
            $("#rowfile").show();
        }else if ($(this).val() === "3") {
            $("#profissao").val('Aluno de Graduação');
            $("#inputfile").attr("required");
            $("#rowfile").show();
        }else if ($(this).val() === "4") {
            $("#profissao").val('Técnico Administrativo');
            $("#inputfile").removeAttr("required");
            $("#rowfile").hide();
        }else {
            $("#profissao").val('');
            $("#inputfile").removeAttr("required");
            $("#rowfile").hide();
        }

    });

});

/* EXIBIR / OCULTAR CAMPOS DOS FORMULÁRIOS DE ACORDO COM A OPTION SELECIONADA */
