<!-- resources/views/pdf_template.blade.php -->
// resources/views/pdf_template.blade.php
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; font-size: 10px; } /* Fonte menor */
        th { background-color: #f2f2f2; }
        .flex-container {
            display: flex;
            align-items: center;
        }
        .logo { width: 100px; margin-right: 20px; }
        .title { font-size: 24px; }
    </style>
</head>
<body>
    <div class="row flex-container">
        <img src="{{ $logoUrl }}" class="logo" alt="Logo">
        <div class="title">{{ $title }}</div>
    </div>
    <table>
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{{ strtoupper($cell) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="{{ count($headers) - 1 }}" style="text-align: right; font-weight: bold;">Total Geral</td>
                <td>{{ strtoupper($totals['totalGeneral']) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
