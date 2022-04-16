<div class="card">
    <div class="card-header">
        {{-- {{ __('Dashboard') }} --}}
        Detail karyawan
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>History</th>
                    </tr>
                    @foreach ($history as $value)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td>{{ $value->pesan }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
