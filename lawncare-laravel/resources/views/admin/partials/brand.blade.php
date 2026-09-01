@php
    $logo = config('site.site.logo');
    $siteName = config('site.site.name');
    $center = $center ?? false;
    $subtitle = $subtitle ?? 'Website Manager';
@endphp

<div class="admin-brand @if($center) admin-brand--center @endif">
    <img
        src="{{ $logo }}"
        alt="{{ $siteName }}"
        class="admin-brand__logo-img"
        width="56"
        height="56"
    >
    <div>
        <p class="admin-brand__title">Lawn Care Admin</p>
        <p class="admin-brand__subtitle">{{ $subtitle }}</p>
    </div>
</div>
