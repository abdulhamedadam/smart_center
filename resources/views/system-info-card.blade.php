<div class="flex flex-wrap items-stretch gap-4">
    <!-- System Info Block -->
    <div class="flex-1 min-w-[250px] p-4 border rounded-lg bg-white">
        <div class="flex items-start gap-3 h-full">
            <div class="flex-shrink-0 text-primary-500 mt-0.5">
                <x-heroicon-o-cog class="w-5 h-5" />
            </div>
            <div class="flex-1">
                <h3 class="font-medium text-gray-800 mb-2">معلومات النظام</h3>
                <div class="space-y-1 text-sm text-gray-600">
                    <p class="flex items-center gap-2">
                        <span class="font-medium">النظام:</span>
                        <span>{{ $systemName }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="font-medium">الإصدار:</span>
                        <span>{{ $systemVersion }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="font-medium">آخر تحديث:</span>
                        <span>{{ $lastUpdate }} ({{ $monthsSinceUpdate }} أشهر)</span>
                    </p>
                </div>
                <div class="mt-3">
                    <span class="px-2 py-1 text-xs rounded-full {{ $isUpdateRequired ? 'bg-danger-100 text-danger-800' : 'bg-success-100 text-success-800' }}">
                        {{ $updateStatus }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Alert Block (Conditional) -->
    @if($isUpdateRequired)
        <div class="flex-1 min-w-[250px] p-4 border rounded-lg bg-danger-50 border-danger-100">
            <div class="flex items-start gap-3 h-full">
                <div class="flex-shrink-0 text-danger-500 mt-0.5">
                    <x-heroicon-o-exclamation-circle class="w-5 h-5" />
                </div>
                <div class="flex-1">
                    <h3 class="font-medium text-danger-800 mb-2">تنبيه التحديث</h3>
                    <p class="text-sm text-danger-600 mb-3">
                        مر أكثر من 3 أشهر على آخر تحديث. يرجى التواصل مع خدمة العملاء.
                    </p>
                    <a href="mailto:{{ $customerServiceEmail }}" class="inline-flex items-center text-sm text-danger-600 hover:underline">
                        <x-heroicon-o-envelope class="w-4 h-4 mr-1" />
                        طلب التحديث
                    </a>
                </div>
            </div>
        </div>
@endif

<!-- Support Block -->
    <div class="flex-1 min-w-[250px] p-4 border rounded-lg bg-white">
        <div class="flex items-start gap-3 h-full">
            <div class="flex-shrink-0 text-info-500 mt-0.5">
                <x-heroicon-o-phone class="w-5 h-5" />
            </div>
            <div class="flex-1">
                <h3 class="font-medium text-gray-800 mb-2">الدعم الفني</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <p class="flex items-center gap-2">
                        <x-heroicon-o-phone class="w-4 h-4 text-info-500" />
                        <a href="tel:{{ $customerServicePhone }}" class="hover:underline">{{ $customerServicePhone }}</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <x-heroicon-o-envelope class="w-4 h-4 text-info-500" />
                        <a href="mailto:{{ $customerServiceEmail }}" class="hover:underline">{{ $customerServiceEmail }}</a>
                    </p>
                </div>
                <div class="mt-3 text-xs text-gray-500">
                    متاح من الأحد إلى الخميس، 8 صباحاً - 5 مساءً
                </div>
            </div>
        </div>
    </div>
</div>
