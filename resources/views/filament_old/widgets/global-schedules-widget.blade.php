<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-4">
            @foreach($this->getSchedules() as $courseName => $schedules)
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">{{ $courseName }}</h3>
                    
                    <div class="grid grid-cols-7 gap-2">
                        @php
                            $days = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
                            $dayLabels = ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
                        @endphp

                        @foreach($days as $index => $day)
                            <div class="border rounded p-2">
                                <div class="font-medium text-center mb-2">{{ $dayLabels[$index] }}</div>
                                @foreach($schedules as $schedule)
                                    @php
                                        $groupDay = $schedule->groupDays->firstWhere('day', $day);
                                    @endphp
                                    @if($groupDay)
                                        <div class="text-sm border-t pt-1 mt-1">
                                            <div class="text-green-600">✓</div>
                                            <div>{{ $groupDay->start_time ? date('H:i', strtotime($groupDay->start_time)) : '' }} - 
                                                 {{ $groupDay->end_time ? date('H:i', strtotime($groupDay->end_time)) : '' }}</div>
                                            <div class="font-medium">{{ $schedule->name }}</div>
                                            <div class="text-gray-600">{{ $schedule->instructor->name ?? '' }}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget> 