<table>
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
            <td>{{ number_format($row['expense'], 2) }}</td>
            <td>{{ number_format($row['budget'], 2) }}</td>
            <td>{{ $row['quarter_percentage'] }}%</td>
            <td>{{ number_format($row['total_budget'], 2) }}</td>
            <td>{{ $row['total_percentage'] }}%</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td>Total Project Expenses</td>
            <td>{{ number_format($report['summary']['total_expense'], 2) }}</td>
            <td>{{ number_format($report['summary']['total_budget'], 2) }}</td>
            <td>{{ $report['summary']['overall_percentage'] }}%</td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
</table>