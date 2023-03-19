<template>
    <div class="manufacturer-block-wrapper">
        <template v-if="display === 'select'">
            <div class="mt-3">
                <div class="manufacturer-block-select-header">{{ $t('pages.products_details_spare_parts.manufacturer') }}</div>

                <div class="col-12">
                    <dropdown-manufacturer :manufacturers="manufacturers" />
                </div>
            </div>
        </template>

        <template v-else-if="display === 'create'">
            <div class="mt-3">
                <div class="manufacturer-block-name-header">{{ $t('pages.products_details_spare_parts.register_manufacturer') }}</div>

                <div class="col-12">
                    <input type="text" class="input w-100" v-model="$parent.add.manufacturer.name" />
                </div>
            </div>
        </template>

        <div class="manufacturer-block-menu">
            <div class="menu-buttons">
                <svg @click="displayMenu()" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.33333 10.8333C3.79357 10.8333 4.16667 10.4602 4.16667 10C4.16667 9.53976 3.79357 9.16666 3.33333 9.16666C2.8731 9.16666 2.5 9.53976 2.5 10C2.5 10.4602 2.8731 10.8333 3.33333 10.8333Z" stroke="black" stroke-width="1.66667"/>
                    <path d="M9.99999 10.8333C10.4602 10.8333 10.8333 10.4602 10.8333 10C10.8333 9.53976 10.4602 9.16666 9.99999 9.16666C9.53975 9.16666 9.16666 9.53976 9.16666 10C9.16666 10.4602 9.53975 10.8333 9.99999 10.8333Z" stroke="black" stroke-width="1.66667"/>
                    <path d="M16.6667 10.8333C17.1269 10.8333 17.5 10.4602 17.5 10C17.5 9.53976 17.1269 9.16666 16.6667 9.16666C16.2064 9.16666 15.8333 9.53976 15.8333 10C15.8333 10.4602 16.2064 10.8333 16.6667 10.8333Z" stroke="black" stroke-width="1.66667"/>
                </svg>

                <div class="menu-buttons-menu" :class="{ 'd-none': !display_menu }">
                    <div class="buttons-menu-link" @click="access('select')">{{ $t('pages.products_details_spare_parts.select_manufacturer') }}</div>
                    <div class="buttons-menu-link" @click="access('create')">{{ $t('pages.products_details_spare_parts.register_manufacturer') }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DropdownManufacturer from './block_manufacturer/DropdownManufacturer.vue'

export default {
    components: { DropdownManufacturer },
    props: [ 'manufacturers' ],
    data: function () {
        return {
            display_menu: false,
        }
    },
    computed: {
        display: function () { return this.$parent.add.manufacturer.display }
    },
    methods: {
        access: function (access) {
            this.$parent.add.manufacturer.display = access
        },
        displayMenu: function () {
            this.display_menu = !this.display_menu
        }
    }
}
</script>