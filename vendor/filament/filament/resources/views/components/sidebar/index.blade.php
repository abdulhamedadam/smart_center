@props([
    'navigation',
])

@php
    $openSidebarClasses = 'fi-sidebar-open w-[--sidebar-width] translate-x-0 shadow-xl ring-1 ring-gray-950/5 dark:ring-white/10 rtl:-translate-x-0';
    $isRtl = __('filament-panels::layout.direction') === 'rtl';
@endphp
<style>
    /* Professional Filament Sidebar Styling */


    .fi-sidebar-nav {
        background-color: #1e293b;
        color: #e2e8f0;
        transition: all 0.3s ease;
        border-right: 1px solid #334155;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }
    .fi-sidebar-group-items{
        background-color: #1e293b;
        color: #e2e8f0;
        transition: all 0.3s ease;
        border-right: 1px solid #334155;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        padding:20px;
    }


    .fi-sidebar-header {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid #334155;
    }


    .fi-sidebar-group-heading {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        padding-left: 0.75rem;
    }


    .fi-sidebar-item {
        border-radius: 0.375rem;
        margin-bottom: 0.375rem;
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
        font-size: 0.9375rem;
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.05);
    }


    .fi-sidebar-item a {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #f1f5f9;
        font-weight: 500;
        text-decoration: none;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
        letter-spacing: 0.01em;
        line-height: 1.5;
        border-left: 3px solid transparent;
    }

    .fi-sidebar-item a svg {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.75rem;
        color: #94a3b8; /* Brighter than before */
        transition: color 0.2s ease;
    }

    .fi-sidebar-item:hover a {
        background-color: #334155;
        color: #f8fafc;
        border-left-color: #60a5fa;
        padding-left: 1.125rem;
    }

    .fi-sidebar-item:hover a svg {
        color: #f8fafc;
        transform: scale(1.05);
    }

    .fi-sidebar-item.active a {
        background-color: #0f172a;
        color: #ffffff;
        border-left-color: #3b82f6;
        font-weight: 600;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .fi-sidebar-item.active a svg {
        color: #3b82f6;
        transform: scale(1.1);
    }

    .fi-sidebar-item.active a::after {
        content: '';
        position: absolute;
        right: 1rem;
        width: 6px;
        height: 6px;
        background-color: #3b82f6;
        border-radius: 50%;
    }

    .fi-sidebar-nav .text-gray-700,
    .fi-sidebar-nav [class*="text-gray-"],
    .fi-sidebar-item .text-gray-700,
    .fi-sidebar-item [class*="text-gray-"] {
        color: #f1f5f9 !important;
    }
    .fi-sidebar-nav::-webkit-scrollbar {
        width: 6px;
    }

    .fi-sidebar-nav::-webkit-scrollbar-track {
        background: #1e293b;
    }

    .fi-sidebar-nav::-webkit-scrollbar-thumb {
        background: #475569;
        border-radius: 3px;
    }

    .fi-sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: #64748b;
    }

    .fi-sidebar-collapse {
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .fi-sidebar-footer {
        margin-top: auto;
        padding: 1rem;
        border-top: 1px solid #334155;
        font-size: 0.875rem;
    }

    @media (max-width: 1024px) {
        .fi-sidebar-nav {
            width: 100%;
            max-width: 250px;
        }
    }
</style>
{{-- format-ignore-start --}}
<aside
    x-data="{}"
    @if (filament()->isSidebarCollapsibleOnDesktop() && (! filament()->hasTopNavigation()))
        x-cloak
        x-bind:class="
            $store.sidebar.isOpen
                ? @js($openSidebarClasses . ' ' . 'lg:sticky')
                : '-translate-x-full rtl:translate-x-full lg:sticky lg:translate-x-0 rtl:lg:-translate-x-0'
        "
    @else
        @if (filament()->hasTopNavigation())
            x-cloak
            x-bind:class="$store.sidebar.isOpen ? @js($openSidebarClasses) : '-translate-x-full rtl:translate-x-full'"
        @elseif (filament()->isSidebarFullyCollapsibleOnDesktop())
            x-cloak
            x-bind:class="$store.sidebar.isOpen ? @js($openSidebarClasses . ' ' . 'lg:sticky') : '-translate-x-full rtl:translate-x-full'"
        @else
            x-cloak="-lg"
            x-bind:class="
                $store.sidebar.isOpen
                    ? @js($openSidebarClasses . ' ' . 'lg:sticky')
                    : 'w-[--sidebar-width] -translate-x-full rtl:translate-x-full lg:sticky'
            "
        @endif
    @endif
    {{
        $attributes->class([
            'fi-sidebar fixed inset-y-0 start-0 z-30 flex flex-col h-screen content-start bg-white transition-all dark:bg-gray-900 lg:z-0 lg:bg-transparent lg:shadow-none lg:ring-0 lg:transition-none dark:lg:bg-transparent',
            'lg:translate-x-0 rtl:lg:-translate-x-0' => ! (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop() || filament()->hasTopNavigation()),
            'lg:-translate-x-full rtl:lg:translate-x-full' => filament()->hasTopNavigation(),
        ])
    }}
>
    <div class="overflow-x-clip">
        <header
            class="fi-sidebar-header flex h-16 items-center bg-white px-6 ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 lg:shadow-sm"
        >
            <div
                @if (filament()->isSidebarCollapsibleOnDesktop())
                    x-show="$store.sidebar.isOpen"
                    x-transition:enter="lg:transition lg:delay-100"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                @endif
            >
                @if ($homeUrl = filament()->getHomeUrl())
                    <a {{ \Filament\Support\generate_href_html($homeUrl) }}>
                        <x-filament-panels::logo />
                    </a>
                @else
                    <x-filament-panels::logo />
                @endif
            </div>

            @if (filament()->isSidebarCollapsibleOnDesktop())
                <x-filament::icon-button
                    color="gray"
                    :icon="$isRtl ? 'heroicon-o-chevron-left' : 'heroicon-o-chevron-right'"
                    {{-- @deprecated Use `panels::sidebar.expand-button.rtl` instead of `panels::sidebar.expand-button` for RTL. --}}
                    :icon-alias="$isRtl ? ['panels::sidebar.expand-button.rtl', 'panels::sidebar.expand-button'] : 'panels::sidebar.expand-button'"
                    icon-size="lg"
                    :label="__('filament-panels::layout.actions.sidebar.expand.label')"
                    x-cloak
                    x-data="{}"
                    x-on:click="$store.sidebar.open()"
                    x-show="! $store.sidebar.isOpen"
                    class="mx-auto"
                />
            @endif

            @if (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop())
                <x-filament::icon-button
                    color="gray"
                    :icon="$isRtl ? 'heroicon-o-chevron-right' : 'heroicon-o-chevron-left'"
                    {{-- @deprecated Use `panels::sidebar.collapse-button.rtl` instead of `panels::sidebar.collapse-button` for RTL. --}}
                    :icon-alias="$isRtl ? ['panels::sidebar.collapse-button.rtl', 'panels::sidebar.collapse-button'] : 'panels::sidebar.collapse-button'"
                    icon-size="lg"
                    :label="__('filament-panels::layout.actions.sidebar.collapse.label')"
                    x-cloak
                    x-data="{}"
                    x-on:click="$store.sidebar.close()"
                    x-show="$store.sidebar.isOpen"
                    class="ms-auto hidden lg:flex"
                />
            @endif
        </header>
    </div>

    <nav class="fi-sidebar-nav flex-grow flex flex-col gap-y-7 overflow-y-auto overflow-x-hidden px-6 py-8"
        style="scrollbar-gutter: stable">
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_NAV_START) }}

        @if (filament()->hasTenancy() && filament()->hasTenantMenu())
            <div
                @class([
                    'fi-sidebar-nav-tenant-menu-ctn',
                    '-mx-2' => ! filament()->isSidebarCollapsibleOnDesktop(),
                ])
                @if (filament()->isSidebarCollapsibleOnDesktop())
                    x-bind:class="$store.sidebar.isOpen ? '-mx-2' : '-mx-4'"
                @endif
            >
                <x-filament-panels::tenant-menu />
            </div>
        @endif

        <ul class="fi-sidebar-nav-groups -mx-2 flex flex-col gap-y-7">
            @foreach ($navigation as $group)
                <x-filament-panels::sidebar.group
                    :active="$group->isActive()"
                    :collapsible="$group->isCollapsible()"
                    :icon="$group->getIcon()"
                    :items="$group->getItems()"
                    :label="$group->getLabel()"
                    :attributes="\Filament\Support\prepare_inherited_attributes($group->getExtraSidebarAttributeBag())"
                />
            @endforeach
        </ul>

        <script>
            var collapsedGroups = JSON.parse(
                localStorage.getItem('collapsedGroups'),
            )

            if (collapsedGroups === null || collapsedGroups === 'null') {
                localStorage.setItem(
                    'collapsedGroups',
                    JSON.stringify(@js(
                        collect($navigation)
                            ->filter(fn (\Filament\Navigation\NavigationGroup $group): bool => $group->isCollapsed())
                            ->map(fn (\Filament\Navigation\NavigationGroup $group): string => $group->getLabel())
                            ->values()
                            ->all()
                    )),
                )
            }

            collapsedGroups = JSON.parse(
                localStorage.getItem('collapsedGroups'),
            )

            document
                .querySelectorAll('.fi-sidebar-group')
                .forEach((group) => {
                    if (
                        !collapsedGroups.includes(group.dataset.groupLabel)
                    ) {
                        return
                    }

                    // Alpine.js loads too slow, so attempt to hide a
                    // collapsed sidebar group earlier.
                    group.querySelector(
                        '.fi-sidebar-group-items',
                    ).style.display = 'none'
                    group
                        .querySelector('.fi-sidebar-group-collapse-button')
                        .classList.add('rotate-180')
                })
        </script>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_NAV_END) }}
    </nav>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_FOOTER) }}
</aside>
{{-- format-ignore-end --}}
