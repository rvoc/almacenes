<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ public_path('css/materialicons.css') }}" media="all" />
    <link rel="stylesheet" href="{{ public_path('css/wkhtml.css') }}" media="all" />
</head>
<body style="border:none">
    <div style=" padding: 35px;">

        <div class="page-break">
        <table class="w-100 ">
            <tr>
                <th class="w-20 text-left no-padding no-margins align-middle">
                    <div class="text-center">
                        <img src="{{ public_path('img/logo_small.jpg') }}" style=" width: 190px;">
                    </div>
                </th>
                <th class="w-50 align-center text-center  ">
                    <span class="font-semibold uppercase leading-tight " >
                        {{ $institution ?? 'EMPRESA BOLIVIANA DE ALIMENTOS Y DERIVADOS' }} <br>

                        {{ $storage ?? 'GERENCIA DE PLANIFICACIÓN Y DESARROLLO' }} <br>
                        {{-- {{ $direction ?? '  DE BENEFICIOS ECONÓMICOS' }} <br>
                        {{ $unit ?? 'UNIDAD DE OTORGACIÓN DE FONDO DE RETIRO POLICIAL, CUOTA MORTUORIA Y AUXILIO MORTUORIO' }} --}}
                    </span>
                </th>
                <th class="w-20 no-padding  align-center">

                    <table class="table-code align-top no-padding no-margins">
                        <tbody>
                            <tr>
                                <td class="text-center bg-grey-darker text-xxs text-white">Fecha de Emisión</td>
                                <td class="text-xs">{{ $date }}</td>
                            </tr>
                            <tr>
                                <td class="text-center bg-grey-darker text-xxs text-white">Usuario</td>
                                <td class="text-xs">{!! $username !!}</td>
                            </tr>
                            <tr>
                                <td class="text-center bg-grey-darker text-xxs text-white">Codigo</td>
                                <td class="text-xs">{!! $code !!}</td>
                            </tr>
                        </tbody>
                    </table>

                </th>
            </tr>
            <tr class="no-border"><td colspan="3" class="no-border" style="border-bottom: 1px solid #22292f;"></td></tr>
            <tr>
                <td colspan="3" class="font-bold text-center text-xl uppercase">
                    {{ $title }}
                    @if (isset($subtitle))
                    <br><span class="font-medium">{{ $subtitle ?? '' }}</span>
                    @endif
                </td>
            </tr>
            {{-- <tr><td colspan="3"></td></tr>
            <tr><td colspan="3"></td></tr> --}}

        </table>

        <div class="block">

            @yield('content')
        </div>
        <footer>
            @yield('footer')
        </footer>
        </div>
    </div>
</body>
</html>
