<!DOCTYPE html>
<html>
<head>
    <title>Financial Report</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        th {
            background: #2f4f4f;
            color: #fff;
            padding: 10px;
        }

        td {
            padding: 8px;
        }

        tfoot {
            background: #f2f2f2;
            font-weight: bold;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
</head>

<body>

<h2>Financial Report</h2>

<div class="card p-3 mb-4">
<form method="GET">

    <div class="row">

        <!-- Fiscal Year -->
        <div class="col-md-3">
            <label>Fiscal Year</label>
            <select name="fiscal_year_id" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year->id }}"
                        {{ request('fiscal_year_id') == $year->id ? 'selected' : '' }}>
                        {{ $year->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quarter -->
        <div class="col-md-2">
            <label>Quarter</label>
            <select name="quarter" class="form-control">
                @for($i=1; $i<=4; $i++)
                    <option value="{{ $i }}"
                        {{ request('quarter') == $i ? 'selected' : '' }}>
                        Q{{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <!-- Division -->
        <div class="col-md-3">
            <label>Division</label>
            <select name="division_ids[]" class="form-control select2" multiple>
                @foreach($divisions as $d)
                    <option value="{{ $d->id }}"
                        {{ collect(request('division_ids'))->contains($d->id) ? 'selected' : '' }}>
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- District -->
        <div class="col-md-4">
            <label>District</label>
            <select name="district_ids[]" class="form-control select2" multiple>
                @foreach($districts as $d)
                    <option value="{{ $d->id }}"
                        {{ collect(request('district_ids'))->contains($d->id) ? 'selected' : '' }}>
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mt-3">

        <!-- Category -->
        <div class="col-md-4">
            <label>Category</label>
            <select name="category_ids[]" class="form-control select2" multiple>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}"
                        {{ collect(request('category_ids'))->contains($c->id) ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Economic Code -->
        <div class="col-md-4">
            <label>Economic Code</label>
            <select name="economic_code_ids[]" class="form-control select2" multiple>
                @foreach($economicCodes as $e)
                    <option value="{{ $e->id }}"
                        {{ collect(request('economic_code_ids'))->contains($e->id) ? 'selected' : '' }}>
                        {{ $e->code }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Button -->
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
        </div>

    </div>

</form>
</div>

<!-- ================= TABLE ================= -->
<div class="mb-3 d-flex justify-content-end gap-2">
    <a href="{{ route('report.download', request()->query()) }}" target="_blank" class="btn btn-success">
        PDF
    </a>
    <a href="{{ route('report.excel', request()->query()) }}" target="_blank" class="btn btn-info">
        Excel
    </a>
</div>
<div class="card p-3">
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
</div>

<!-- ✅ jQuery (MUST FIRST) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ✅ Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    $('.select2').select2({
        placeholder: "Select options",
        allowClear: true,
        width: '100%'
    });
});
</script>

</body>
</html>