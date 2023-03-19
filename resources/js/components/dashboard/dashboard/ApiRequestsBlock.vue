<template>
    <div class="api-block">
        <div class="api-block-header">
            <router-link to="/admin/api_keys">{{ $t('pages.dashboard.api_requests.api_requests') }}</router-link>
        </div>

        <div class="api-block-general-stats">
            36 {{ $t('pages.dashboard.api_requests.api_keys') }}
        </div>

        <div class="api-block-use-stats">
            <div class="stats-api">
                <div class="grid">
                    <div class="col-5">{{ $t('pages.dashboard.api_requests.this_month') }}</div>
                    <div class="col-7">3 000 000 {{ $t('pages.dashboard.api_requests.requests') }}</div>
                </div>
                <div class="grid">
                    <div class="col-5">{{ $t('pages.dashboard.api_requests.this_week') }}</div>
                    <div class="col-7">2 000 000 {{ $t('pages.dashboard.api_requests.requests') }}</div>
                </div>
                <div class="grid">
                    <div class="col-5">{{ $t('pages.dashboard.api_requests.this_day') }}</div>
                    <div class="col-7">1 000 000 {{ $t('pages.dashboard.api_requests.requests') }}</div>
                </div>
                <div class="grid">
                    <div class="col-5">{{ $t('pages.dashboard.api_requests.this_hour') }}</div>
                    <div class="col-7">100 000 {{ $t('pages.dashboard.api_requests.requests') }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
