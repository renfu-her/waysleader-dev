<div class="database-status">
    @if ($dbStatus['status'])
        <div class="alert alert-success">
            <p>{{ $dbStatus['message'] }}</p>
            <p>當前資料庫: {{ $dbStatus['database'] }}</p>
        </div>
    @else
        <div class="alert alert-danger">
            <p>{{ $dbStatus['message'] }}</p>
        </div>
    @endif
</div>
