@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 pt-4">
                <button id="add-movement" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-movement-modal">Añadir Movimiento</button>
            </div>
            <div class="col-6 pt-4">
                <input class="form-control" id="movements-filter" type="text" placeholder="Filtrar...">
            </div>
        </div>
        <div id="row-add-movement" class="row" style="display:none;">
            <div class="col-4 pt-4">
                <select id="movement-type" class="form-control">
                    <option value="">Seleccionar tipo</option>
                    <option value="add_stock">Añadir stock</option>
                    <option value="sale">Venta</option>
                    <option value="sale_canceled">Venta cancelada</option>
                </select>
            </div>
            <div class="col-2 pt-4">
                <input id="movement-amount" type="number" class="form-control" placeholder="Cantidad">
            </div>
            <div class="col-3 pt-4">
                <button id="save-movement" type="button" class="btn btn-primary mb-2">Añadir</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pt-4 ml-4">
                <table id="movements-table" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tipo movimiento</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Última actualización</th>
                        </tr>
                    </thead>
                    <tbody id="movements-table-content"></tbody>
                </table>
            </div>
        </div>
    </div>
@stop
