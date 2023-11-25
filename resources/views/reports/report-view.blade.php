<h1>Nombre de la Unidad {{ $unidad->name }}</h1>
<h4>Reporte de Logros de Inteligencia de fecha {{ $date }} 06:00:00 hasta el {{ $dateNext }} 05:59:59</h4>
<table class="table">
    <thead>
    <tr>
        <th rowspan="{{ count($criminal_groups) + 1 }}">GRUPOS DELICTIVOS ORGANIZADOS</th>
        <th scope="col">#</th>
        <th scope="col">Categoría</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($criminal_groups as $cg)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $cg->category }}</td>
            <td>{{ $cg->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th rowspan="{{ count($currencies) + 1 }}">MONEDA NACIONAL Y EXTRANJERA</th>
        <th scope="col">#</th>
        <th scope="col">Categoría</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($currencies as $c)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $c->category }}</td>
            <td>{{ $c->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th rowspan="{{ count($drugs) + 1 }}">DROGAS</th>
        <th scope="col">#</th>
        <th scope="col">Categoría</th>
        <th scope="col">Total toneladas</th>
        <th scope="col">Total kilogramos</th>
        <th scope="col">Total gramos</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($drugs as $d)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $d->category }}</td>
            <td>{{ $d->totalTon }}</td>
            <td>{{ $d->totalKilogram }}</td>
            <td>{{ $d->totalGram }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th rowspan="{{ count($explosives) + 1 }}">EXPLOSIVOS</th>
        <th scope="col">#</th>
        <th scope="col">Categoría</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($explosives as $e)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $e->category }}</td>
            <td>{{ $e->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th rowspan="{{ count($firearms) + 1 }}">ARMAS DE FUEGO O DE GUERRA INCAUTADAS</th>
        <th scope="col">#</th>
        <th scope="col">Categoría</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($firearms as $f)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $f->category }}</td>
            <td>{{ $f->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th rowspan="{{ count($fuels) + 1 }}">COMBUSTIBLE</th>
        <th scope="col">#</th>
        <th scope="col">Categoría</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($fuels as $f)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $f->category }}</td>
            <td>{{ $f->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th rowspan="{{ count($persons) + 1 }}">PERSONAS</th>
        <th scope="col">#</th>
        <th scope="col">Categoría</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($persons as $p)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $p->category }}</td>
            <td>{{ $p->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th rowspan="{{ count($others) + 1 }}">OTROS</th>
        <th scope="col">#</th>
        <th scope="col">Categoría</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($others as $o)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $o->category }}</td>
            <td>{{ $o->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
