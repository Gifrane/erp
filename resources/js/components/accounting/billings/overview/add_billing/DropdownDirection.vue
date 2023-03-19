<template>
    <div :id="dropdownId" class="dropdown w-100">
        <div class="dropdown-head" @click="displayDropdownAction()">
            <div class="dh-title placeholder" v-if="selected === null"></div>
            <div class="dh-title" v-else>{{ selected }}</div>

            <div class="dh-arrow">
                <span class="material-icons" v-if="displayDropdown">arrow_drop_up</span>
                <span class="material-icons" v-else>arrow_drop_down</span>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="dm-list">
                <div class="dml-item" v-for="d in directions" :key="d.code" @click="select(d)">{{ d.label }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    data: function () {
        return {
            dropdownId: 'dropdown-add-billing-direction',

            directions: [],

            selected: null
        }
    },
    created: function () {
        this.directions = [ 'expense', 'income' ].map((d) => {
            return { code: d, label: this.$t('pages.accounting_billings.directions.'+d) }
        })
    },
    methods: {
        select: function (d) {
            this.selected = d.label

            this.$parent.add.direction = d.code

            this.displayDropdown = false
        }
    }
}
</script>
