<!-- Edit Work Hours Modal -->
<div class="modal fade" id="editJadwal-{{ $key }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Edit Jam Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('jadwal-kerja.update', $key) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <!-- Day Select -->
                        <div class="mb-3 col-md-12">
                            <label for="day" class="form-label">Hari</label>
                            <select class="form-control" id="day" name="day" required>
                                @for ($i = 0; $i < 7; $i++)
                                    @php
                                        \Carbon\Carbon::setLocale('id');
                                        $date = \Carbon\Carbon::now()->startOfWeek()->addDays($i);
                                        $dayName = $date->translatedFormat('l');
                                    @endphp
                                    <option value="{{ $dayName }}"
                                        {{ ($item['day'] ?? '') == $dayName ? 'selected' : '' }}>
                                        {{ $dayName }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        @php
                            $timeOptions = [];
                            $startTime = \Carbon\Carbon::createFromTime(0, 0);
                            $endTime = \Carbon\Carbon::createFromTime(23, 30);

                            while ($startTime <= $endTime) {
                                $timeOptions[] = $startTime->format('H:i');
                                $startTime->addMinutes(30);
                            }
                        @endphp

                        <!-- Start Time Select -->
                        <div id="start-time-group" class="mb-3 col-md-6">
                            <label for="waktu_mulai" class="form-label">waktu mulai</label>
                            <select class="form-control" id="waktu_mulai" name="waktu_mulai" required>
                                @foreach ($timeOptions as $timeOption)
                                    <option value="{{ $timeOption }}"
                                        {{ ($item['waktu_mulai'] ?? '') == $timeOption ? 'selected' : '' }}>
                                        {{ $timeOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- End Time Select -->
                        <div id="end-time-group" class="mb-3 col-md-6">
                            <label for="waktu_selesai" class="form-label">waktu selesai</label>
                            <select class="form-control" id="waktu_selesai" name="waktu_selesai" required>
                                @foreach ($timeOptions as $timeOption)
                                    <option value="{{ $timeOption }}"
                                        {{ ($item['waktu_selesai'] ?? '') == $timeOption ? 'selected' : '' }}>
                                        {{ $timeOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Holiday Checkbox -->
                        <div class="mb-3 col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_holiday" name="is_holiday"
                                    value="1" {{ $item['is_holiday'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_holiday">Apakah Hari Ini libur??</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
