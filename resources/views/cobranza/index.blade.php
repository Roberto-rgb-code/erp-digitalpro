@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Control de Cuentas por Cobrar</h4>
        </div>
        <div class="card-body p-2">
            <table class="table table-bordered table-hover table-sm align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Item</th>
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Contacto</th>
                        <th>Vendedor</th>
                        <th>Qty de Pagos</th>
                        <th>Fechas</th>
                        <th>Acuerdos</th>
                        <th>Total del adeudo</th>
                        <th>Pago Inicial</th>
                        <th>Total abonado</th>
                        <th>Adeudo</th>
                        <th>Pago 1</th>
                        <th>Pago 2</th>
                        <th>Pago 3</th>
                        <th>Pago 4</th>
                        <th>Pago 5</th>
                        <th>Pago 6</th>
                        <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cuentas as $index => $cuenta)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $cuenta->folio }}</td>
                        <td>{{ \Carbon\Carbon::parse($cuenta->fecha)->format('d-M') }}</td>
                        <td>{{ $cuenta->cliente->nombre }}</td>
                        <td>{{ $cuenta->contacto }}</td>
                        <td>{{ $cuenta->vendedor->nombre }}</td>
                        <td>{{ $cuenta->qty_pagos }}</td>
                        <td>
                            @if(is_array($cuenta->fechas_pagos))
                                @foreach($cuenta->fechas_pagos as $fp)
                                    <div>{{ $fp }}</div>
                                @endforeach
                            @else
                                {{ $cuenta->fechas_pagos }}
                            @endif
                        </td>
                        <td>{{ $cuenta->acuerdos }}</td>
                        <td>${{ number_format($cuenta->total_adeudo,2) }}</td>
                        <td>${{ number_format($cuenta->pago_inicial,2) }}</td>
                        <td>${{ number_format($cuenta->total_abonado,2) }}</td>
                        <td>${{ number_format($cuenta->adeudo,2) }}</td>
                        @for($i = 1; $i <= 6; $i++)
                            <td>
                                @if(isset($cuenta->pagos[$i-1]))
                                    ${{ number_format($cuenta->pagos[$i-1]->monto,2) }}
                                @endif
                            </td>
                        @endfor
                        <td>
                            <span class="badge 
                                @if($cuenta->status == 'Pagado') bg-success
                                @elseif($cuenta->status == 'Pendiente') bg-warning text-dark
                                @else bg-danger
                                @endif">
                                {{ $cuenta->status }}
                            </span>
                        </td>
                        <td>
                            <!-- Aquí puedes agregar acciones como editar, eliminar, registrar pago, etc. -->
                            <a href="{{ route('cobranza.show', $cuenta->id) }}" class="btn btn-sm btn-primary">Ver</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{ route('cobranza.create') }}" class="btn btn-success mt-2">Agregar Cuenta por Cobrar</a>
        </div>
    </div>
</div>
@endsection
