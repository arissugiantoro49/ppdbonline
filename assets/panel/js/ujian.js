function getText(html) {
    let tmp = document.createElement("div");
    tmp.innerHTML = html;
    return tmp.textContent;
}

let dt;
function fnInitializeDataTable(url, columns, rowid) {
    if ($.fn.DataTable.isDataTable('#tabelDaftarSoal')) {
        $('#tabelDaftarSoal').empty().append('<table id="tabelDaftarSoal" class="table table-striped"></table>');
    }

    let t = $('#tabelDaftarSoal').DataTable({
        ajax: {
            url: url,
            dataSrc: ""
        },
        sDom: '<"toolbar">Bfrtp',
        aoColumns: columns,
        rowId: rowid,
        destroy: true,
        searching: false
    });
    t.on( 'draw.dt', function () {
        var PageInfo = $('#tabelDaftarSoal').DataTable().page.info();
            t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
            t.column(5, { page: 'current' }).nodes().each( function (cell, i) {
                const id = t.rows().ids()[i];
                const idSoal = t.rows().data()[i]["id_soal"];
                cell.innerHTML = `
                    <a class="btn btn-primary" onclick="detailSoal(this)" data-id-soal="${idSoal}"><i class="icon-info22"></i></a>
                    <a class="btn btn-danger" onclick="hapusSoal(this)" data-id-soal="${id}"><i class="icon-minus2"></i></a>
                `;
            });
        } );
    return t;
}

function showToast(success, message) {
    let backgroundColor;
    if (success) {
      backgroundColor = "linear-gradient(135deg, #73a5ff, #5477f5)";
    } else {
      backgroundColor = "linear-gradient(to right, rgb(255, 95, 109), rgb(255, 195, 113))";
    }
  
    Toastify({
      text: message,
      duration: 3000,
      close: true,
      gravity: "top",
      position: "right",
      backgroundColor: backgroundColor,
      stopOnFocus: true,
    }).showToast();
  }

$(document).ready(function () {

    $('#openBtn').click(function () {
        $('#myModal').modal({
            show: true
        })
    });


    $('.modal').on('hidden.bs.modal', function (event) {
        $(this).removeClass('fv-modal-stack');
        $('body').data('fv_open_modals', $('body').data('fv_open_modals') - 1);
    });


    $('.modal').on('shown.bs.modal', function (event) {

        // keep track of the number of open modals

        if (typeof ($('body').data('fv_open_modals')) == 'undefined') {
            $('body').data('fv_open_modals', 0);
        }


        // if the z-index of this modal has been set, ignore.

        if ($(this).hasClass('fv-modal-stack')) {
            return;
        }

        $(this).addClass('fv-modal-stack');

        $('body').data('fv_open_modals', $('body').data('fv_open_modals') + 1);

        $(this).css('z-index', 1040 + (10 * $('body').data('fv_open_modals')));

        $('.modal-backdrop').not('.fv-modal-stack')
            .css('z-index', 1039 + (10 * $('body').data('fv_open_modals')));


        $('.modal-backdrop').not('fv-modal-stack')
            .addClass('fv-modal-stack');

    });


});