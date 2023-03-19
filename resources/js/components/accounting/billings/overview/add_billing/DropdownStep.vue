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
                <div class="dml-item" v-for="s in steps" :key="s.code" @click="select(s)">{{ s.label }}</div>
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

            steps: [],

            selected: null
        }
    },
    created: function () {
        this.steps = [ 'waiting', 'settled' ].map((s) => {
            return { code: s, label: this.$t('pages.accounting_billings.steps.'+s) }
        })
    },
    methods: {
        select: function (s) {
            this.selected = s.label

            this.$parent.add.step = s.code

            this.displayDropdown = false
        }
    }
}
</script>
