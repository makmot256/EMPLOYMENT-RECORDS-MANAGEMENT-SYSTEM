<!-- resources/views/performance-report.blade.php -->

<h1>Performance Report for {{ $employee->name }}</h1>
<p>Average Rating: {{ number_format($averageRating, 2) }}</p>

<table>
    <thead>
        <tr>
            <th>Rating</th>
            <th>Feedback</th>
            <th>Review Period</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->feedback }}</td>
                <td>{{ \Carbon\Carbon::parse($review->review_period)->format('F Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
