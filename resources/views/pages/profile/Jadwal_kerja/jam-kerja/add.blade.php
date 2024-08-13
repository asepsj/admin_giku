<!-- Modal -->
<div class="modal fade" id="tambahjam" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Jam Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('jadwal-kerja.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="day" class="form-label">Hari</label>
                            <select class="form-control" id="day" name="day" required>
                                <option value="">Pilih Hari</option>

                                @for ($i = 0; $i < 7; $i++)
                                    @php
                                        $selectedDays = [];
                                        if ($schedules) {
                                            foreach ($schedules as $schedule) {
                                                $selectedDays[] = $schedule['day'];
                                            }
                                        }
                                        \Carbon\Carbon::setLocale('id');
                                        $date = \Carbon\Carbon::now()->startOfWeek()->addDays($i);
                                        $dayName = $date->translatedFormat('l');
                                    @endphp
                                    @if (!in_array($dayName, $selectedDays))
                                        <option value="{{ $dayName }}">
                                            {{ $dayName }}
                                        </option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3 col-md-6" id="start-time-group">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <select class="form-control" id="waktu_mulai" name="waktu_mulai" required>
                                <option value="">Pilih Waktu Mulai</option>
                                @php
                                    $timeOptions = [];
                                    $startTime = \Carbon\Carbon::createFromTime(0, 0);
                                    $endTime = \Carbon\Carbon::createFromTime(23, 30);

                                    while ($startTime <= $endTime) {
                                        $timeOptions[] = $startTime->format('H:i');
                                        $startTime->addMinutes(30);
                                    }
                                @endphp
                                @foreach ($timeOptions as $timeOption)
                                    <option value="{{ $timeOption }}">{{ $timeOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6" id="end-time-group">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <select class="form-control" id="waktu_selesai" name="waktu_selesai" required>
                                <option value="">Pilih Waktu Selesai</option>
                                @foreach ($timeOptions as $timeOption)
                                    <option value="{{ $timeOption }}">{{ $timeOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_holiday" name="is_holiday"
                                    value="1">
                                <label class="form-check-label" for="is_holiday">Apakah hari ini libur??</label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
