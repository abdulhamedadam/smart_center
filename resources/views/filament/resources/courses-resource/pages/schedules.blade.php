<x-filament::page>
    @include('filament.resources.courses-resource.pages.details')

    <x-filament::card>
        <div>
            <h3 class="text-lg font-medium mb-4">Add New Schedule</h3>
            <div style="margin-top: 10px">
                {{ $this->form }}
            </div>
        </div>
    </x-filament::card>

    @if(!empty($this->monthlySchedule))
        <x-filament::card class="mt-6">
            <div class="overflow-x-auto">
                <h3 class="text-lg font-medium mb-4">Course Schedule</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Week</th>
                        @foreach($this->monthlySchedule as $month)
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ $month['month_name'] }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @for($week = 1; $week <= 4; $week++)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Week {{ $week }}
                            </td>

                            @foreach($this->monthlySchedule as $monthKey => $month)

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if(!empty($month['weeks'][$week]))
                                        @foreach($month['weeks'][$week] as $schedule)

                                            @php

                                                $nextScheduleDate = null;
                                                $style = 'background-color: #f9fafb;';
                                                $textColor = 'color: #1f2937;';

                                                if(isset($schedule['status'])) {
                                                    if($schedule['status'] === 'completed') {
                                                        $style = 'background-color: #f0fdf4;';
                                                        $textColor = 'color: #166534;';
                                                    } elseif($schedule['status'] === 'cancelled' || (isset($schedule['date']) && strtotime($schedule['date']) < strtotime('today'))) {
                                                        $style = 'background-color: #fef2f2;';
                                                        $textColor = 'color: #991b1b;';
                                                    } elseif($schedule['status'] === 'postponed') {
                                                        $style = 'background-color: #fff7ed;';
                                                        $textColor = 'color: #9a3412;';
                                                    } elseif( $schedule['date'] == $nextScheduleDate) {
                                                        $style = 'background-color: #3da142;';
                                                        $textColor = 'color: #1e40af;';
                                                    }
                                                }
                                                $hoverStyle = str_replace('background-color: ', 'background-color: lighten(', $style);
                                                $hoverStyle = str_replace(';', ', 5%);', $hoverStyle);
                                            @endphp

                                            <div
                                                class="mb-2 p-2 rounded cursor-pointer"
                                                style="{{ $style }} transition: background-color 0.2s; {{ $textColor }}"
                                                onmouseover="this.style.cssText += '{{ $hoverStyle }}'"
                                                onmouseout="this.style.cssText = '{{ $style }} {{ $textColor }}'"
                                                wire:click="editSchedule('{{$schedule['id']}}')"
                                                onclick="openModal('{{$schedule['id']}}')">
                                                <div style="font-weight: 500;">{{ $schedule['day'] }}</div>
                                                <div>{{ $schedule['date'] }}</div>
                                                <div>{{ $schedule['start_time'] }} - {{ $schedule['end_time'] }}</div>
                                                @if(isset($schedule['status']))
                                                    <div style="font-size: 0.75rem; font-weight: 600; margin-top: 0.25rem;">{{__('common.status')}}: {{ __('common.'.ucfirst($schedule['status'])) }}</div>
                                                @endif
                                            </div>
                                            <x-filament::modal id="decisionModal-{{$schedule['id']}}" :close-button="true" width="3xl">
                                                <form wire:submit.prevent="saveSchedule('{{$schedule['id']}}')">
                                                    <x-slot name="heading">
                                                        <div class="relative w-full">
                                                            <h2 class="text-lg font-semibold text-right w-full pr-4">Edit Schedule</h2>
                                                        </div>
                                                    </x-slot>

                                                    <div id="modalContent" class="p-4">
                                                        {{ $this->editForm }}
                                                    </div>

                                                    <div class="flex justify-end p-4 border-t">
                                                        <x-filament::button color="success" type="submit">
                                                            Save Changes
                                                        </x-filament::button>
                                                    </div>
                                                </form>
                                            </x-filament::modal>
                                        @endforeach
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </x-filament::card>
    @else
        <x-filament::card class="mt-6">
            <div class="p-4 text-center text-gray-500">
                No schedules found for this course.
            </div>
        </x-filament::card>
    @endif
</x-filament::page>
<script>
    function openModal(scheduleId) {

        setTimeout(() => {
            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: {
                    id: 'decisionModal-' + scheduleId
                }
            }));
        }, 100);
    }
</script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('refresh', () => {
            console.log('Refresh event received');
            window.location.reload();
        });
    });

    document.addEventListener('refresh', () => {
        console.log('Refresh event received');
        window.location.reload();
    });
</script>
