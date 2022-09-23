@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 pt-4">
                <input class="form-control" id="products-filter" type="text" placeholder="Filtrar...">
            </div>
        </div>
        <div class="row">
            <div class="col-12 pt-4 ml-4">
                <table id="products-table" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Última actualización</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="products-table-content"></tbody>
                </table>
            </div>
        </div>
    </div>
@stop
