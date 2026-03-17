<!DOCTYPE html>
<html>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,sans-serif;">

<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="padding:40px 0;">
    <tr>
        <td align="center">
            <h1>Roles list on page {{ $page }}</h1>
            <table role="presentation" width="500" cellspacing="0" cellpadding="0" style="background:#ffffff;border-radius:10px;padding:30px;text-align:center;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>guard_name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->guard_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
