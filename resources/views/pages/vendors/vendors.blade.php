@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Modems</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.col-lg-12 -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Modems
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>MAC Address</th>
                                <th>IP Address</th>
                                <th>Modelo</th>
                                <th>Version del Sowftware</th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($vendors as $vendor)
                                <tr>
                                    <td>{{$vendor->modem_macaddr}}</td>
                                    <td>{{$vendor->ipaddr}}</td>
                                    <td>{{$vendor->vsi_model}}</td>
                                    <td>{{$vendor->vsi_vendor}}</td>
                                    <td>{{$vendor->vsi_swver}}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
