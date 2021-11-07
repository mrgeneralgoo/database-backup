<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div style="text-align: center;">
    <table>
        <tbody>
        <tr>
            <th scope="col">
                <p>
                    <span>Time</span>
                </p>
            </th>
            <th scope="col">
                <p>
                    <span>Database</span>
                </p>
            </th>
            <th scope="col">
                <p>
                    <span>Result</span>
                </p>
            </th>
        </tr>
        @foreach ($backupResult as $result)
            <tr>
                <td>{{$result['time']}}</td>
                <td>{{$result['database']}}</td>
                @if ($result['isSuccess'])
                    <td style="color:#86C166"> Y</td>
                @else
                    <td style="color: #CB1B45"> X</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
