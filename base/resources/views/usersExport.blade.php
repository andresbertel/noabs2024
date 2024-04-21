<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $user->nombres }}</td>
            <td>{{ $user->apellidos }}</td>
        </tr>
    @endforeach
    </tbody>
</table>