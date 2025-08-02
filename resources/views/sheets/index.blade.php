<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>座席表</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #444; padding: 8px; text-align: center; }
        .screen { background: #eee; }
    </style>
</head>
<body>
    <h1>座席表</h1>

    <table>
        <thead>
            <tr>
                @foreach ($columns as $colIndex => $col)
                    @if ($colIndex === floor(count($columns)/2))
                        <th class="screen" colspan="1">スクリーン</th>
                    @else
                        <th></th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($layout as $row => $seats)
                <tr>
                    @foreach ($columns as $col)
                        <td>{{ $row }}-{{ $col }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>