import './bootstrap';
import jQuery from 'jquery';

window.$ = jQuery;

$(document).ready(function () {
    $.ajaxSetup({
        headers:
            {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    if ($('#products-table').length > 0) {
        generateProductsTableContent();

        $("#products-filter").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#products-table-content tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    }

    if ($('#movements-table').length > 0) {
        var productId = window.location.pathname.split("/").pop();
        generateMovementsTableContent(productId);

        $('#movements-filter').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#movements-table-content tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#add-movement').on('click', function () {
            $('#row-add-movement').show();
        });

        $('#save-movement').on('click', function (e) {
            e.preventDefault();

            if (checkFormData()) {
                var uuid = generateNewUuid();
                $.ajax({
                    url: "/movements/" + uuid,
                    method: "PUT",
                    contentType: "application/json",
                    data: JSON.stringify({
                        product_id: productId,
                        type: $('#movement-type').val(),
                        amount: $('#movement-amount').val()
                    }),
                    success: function (data, textStatus, jqXHR) {
                        location.reload(true);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('error');
                    }
                });
            }
            ;
        });
    }

    function generateProductsTableContent() {
        $.ajax({
            url: "products",
            method: "GET",
            contentType: "application/json",
            success: function (data, textStatus, jqXHR) {
                $('#products-table-content').empty();
                $.each(data.data, function (key, val) {
                    var date = formatDateTime(val.updated_at);
                    $('#products-table-content').append('<tr><td>' + val.name + '</td><td>' + val.stock + '</td><td>' + date + '</td><td><a href="view-movements/' + val.id + '"><button type="button" class="btn btn-primary">Movimientos</button></a></td></tr>');
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error');
            }
        });
    }

    function generateMovementsTableContent(productId) {
        $.ajax({
            url: "/movements",
            method: "GET",
            contentType: "application/json",
            data: {
                product_id: productId,
                per_page: 20,
                page: 1
            },
            success: function (data, textStatus, jqXHR) {
                $('#movements-table-content').empty();
                $.each(data.data, function (key, val) {
                    var textType = textTypeMovement(val.type);
                    var date = formatDateTime(val.updated_at);
                    $('#movements-table-content').append('<tr><td>' + textType + '</td><td>' + val.amount + '</td><td>' + date + '</td></tr>');
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error');
            }
        });
    }

    function textTypeMovement(type) {
        var textType = '';
        switch (type) {
            case 'add_stock':
                textType = 'Añadir stock';
                break;
            case 'sale':
                textType = 'Venta';
                break;
            case 'sale_canceled':
                textType = 'Venta cancelada';
                break;
        }

        return textType;
    }

    function formatDateTime(val) {
        var date = new Date(val);
        var dateFormatted =
            ('0' + date.getDate()).substr(-2) + '-' +
            ('0' + (date.getMonth() + 1)).substr(-2) + '-' +
            date.getFullYear() + ' ' +
            ('0' + date.getHours()).substr(-2) + ':' +
            ('0' + date.getMinutes()).substr(-2) + ':' +
            ('0' + date.getSeconds()).substr(-2);

        return dateFormatted;
    }

    function checkFormData() {
        var check = true;
        $('#movement-type').css('border', '1px solid #cccccc');
        $('#movement-amount').css('border', '1px solid #cccccc');

        if ($('#movement-type').val() === '') {
            $('#movement-type').css('border', '1px solid red');
            check = false;
        }

        if ($('#movement-amount').val() === '' || $('#movement-amount').val() === 0) {
            $('#movement-amount').css('border', '1px solid red');
            check = false;
        }

        return check;
    }

    function generateNewUuid() {
        var dt = new Date().getTime();
        var newUuid = 'xxxxxxxx-xxxx-xxxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = (dt + Math.random() * 16) % 16 | 0;
            dt = Math.floor(dt / 16);
            return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });

        return newUuid;
    }
});
