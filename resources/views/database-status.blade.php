<div class="database-status">
    @if ($dbStatus['status'])
        <div class="alert alert-success">
            <p>{{ $dbStatus['message'] }}</p>
            <p>當前資料庫: {{ $dbStatus['database'] }}</p>
            <p>主機: {{ $dbStatus['host'] }}</p>
            <p>用戶名: {{ $dbStatus['username'] }}</p>
            <p>密碼: {{ $dbStatus['password'] }}</p>
        </div>
    @else
        <div class="alert alert-danger">
            <p>{{ $dbStatus['message'] }}</p>
            <p>主機: {{ $dbStatus['host'] }}</p>
            <p>用戶名: {{ $dbStatus['username'] }}</p>
            <p>密碼: {{ $dbStatus['password'] }}</p>
        </div>
    @endif
</div>
