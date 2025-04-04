<table>
    <thead>
        <tr>
            <th colspan="2" style="text-align: left; font-size: 16px;"><b>HR, Payroll, and Attendance Report</b></th>
        </tr>
        <tr>
            <th>Total Employees</th>
            <td>{{ $total_employees }}</td>
        </tr>
        <tr>
            <th>Total Payroll Amount</th>
            <td>{{ $total_payroll }}</td>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="2"><b>Attendance Statistics</b></th>
        </tr>
        <tr>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendance_stats as $stat)
        <tr>
            <td>{{ $stat->status }}</td>
            <td>{{ $stat->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
