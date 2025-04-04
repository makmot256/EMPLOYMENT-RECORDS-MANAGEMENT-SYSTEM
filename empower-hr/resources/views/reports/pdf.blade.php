<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HR, Payroll, and Attendance Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>HR, Payroll, and Attendance Report</h1>
    <p><strong>Total Employees:</strong> {{ $reportData['total_employees'] }}</p>
    <p><strong>Total Payroll Amount:</strong> {{ $reportData['total_payroll'] }}</p>

    <h2>Attendance Statistics</h2>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData['attendance_stats'] as $stat)
            <tr>
                <td>{{ $stat->status }}</td>
                <td>{{ $stat->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
