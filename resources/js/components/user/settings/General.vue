<template>
    <div class="tab">
        <div class="tab-part-theme">
            <div class="theme-title">{{ $t('theme') }}</div>

            <div class="theme-input">
                <div class="theme-input-light">
                    <label><input type="radio" /> Light</label>
                </div>

                <div class="theme-input-dark">
                    <label><input type="radio" /> Dark</label>
                </div>

                <icon-in-progress />
                <icon-success />
                <icon-fail />
            </div>
        </div>
    </div>
</template>

<script>
export default {
}
</script>