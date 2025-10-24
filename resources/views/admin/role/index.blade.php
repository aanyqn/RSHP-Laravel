<table border="1" cellpadding="8" cellspacing="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $index => $role)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $role->nama_role }}</td>
            </tr>
        @endforeach
    </tbody>
</table>