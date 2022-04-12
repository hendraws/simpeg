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
                        <th>Cabang</th>
                        <th>Berkas</th>
                    </tr>
                    @foreach ($history as $value)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td>{{ $value->pesan }}</td>
                            <td>
                                @if (empty($value->cabang))
                                    -
                                @else
                                    {{ $value->cabang }}
                                @endif
                            </td>
                            <td>
                                @if (empty($value->dokumen))
                                    -
                                @else
                                <a href="{{ Storage::url($value->dokumen) }}">Download</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
