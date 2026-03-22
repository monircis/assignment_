<!DOCTYPE html>
<html>
<head>
    <title>Financial Report PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial; padding: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        th { background: #2f4f4f; color: #fff; padding: 10px; }
        td { padding: 8px; }
        tfoot { background: #f2f2f2; font-weight: bold; }
    </style>
</head>
<body>

<h2>Financial Report</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Cost Category</th>
            <th>Expenses ({{ $report['date'] }})</th>
            <th>Budget</th>
            <th>Budget %</th>
            <th>Total Budget</th>
            <th>Total %</th>
        </tr>
    </thead>
    <tbody>
        @foreach($report['data'] as $row)
            <tr>
                <td>{{ $row['category'] }}</td>
                <td class="text-end">{{ number_format($row['expense'], 2) }}</td>
                <td class="text-end">{{ number_format($row['budget'], 2) }}</td>
                <td class="text-end">{{ $row['quarter_percentage'] }}%</td>
                <td class="text-end">{{ number_format($row['total_budget'], 2) }}</td>
                <td class="text-end">{{ $row['total_percentage'] }}%</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td>Total Project Expenses</td>
            <td class="text-end">{{ number_format($report['summary']['total_expense'], 2) }}</td>
            <td class="text-end">{{ number_format($report['summary']['total_budget'], 2) }}</td>
            <td class="text-end">{{ $report['summary']['overall_percentage'] }}%</td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
</table>

</body>
</html>