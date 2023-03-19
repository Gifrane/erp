<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-head" @click="displayDropdownAction()">
            <div class="dh-title placeholder" v-if="selected.length === 0"></div>
            <div class="dh-badges" v-else>
                <div class="badge" v-for="(name, id) in selected" :key="id">
                    <div class="badge-wrapper">
                        <div class="badge-label">{{ name }}</div>
                        <div class="badge-delete">
                            <span class="material-icons" @click.stop="deleteSelection(id)">close</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dh-arrow">
                <span class="material-icons" v-if="displayDropdown">arrow_drop_up</span>
                <span class="material-icons" v-else>arrow_drop_down</span>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <template v-if="values.length > 0">
                <div class="dm-search" v-if="values.length > 4">
                    <input type="search" v-model="search" class="input w-100" :placeholder="$t('search')" />
                </div>

                <div class="dm-list">
                    <template v-for="v in values">
                        <div class="dml-selectable-item" :key="c.id" v-if="!search || regexSearch(c.name)">
                            <div class="dmlsi-checkbox">
                                <input type="checkbox" v-model="$parent.add.values" :value="c.id"
                                    @change="updateSelection(c.id, c.name)" :id="'add-company-'+c.id" />
                            </div>

                            <label class="dmlsi-label" :for="'add-company-'+c.id">{{ c.name }}</label>
                        </div>
                    </template>
                </div>
            </template>

            <div class="dm-empty" v-else>{{ $t('no_company_found') }}</div>
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
            dropdownId: 'dropdown-add-filter-values',

            selected: {},
            search: null
        }
    },
    methods: {
        updateValues: function (filter) {},
        deleteSelection: function (id) {
            delete this.selected[ id ]

            this.$parent.add.companies = this.$parent.add.companies.filter((c) => c !== id)
        },
        updateSelection: function (id, name) {
            if (id in this.selected) {
                delete this.selected[ id ]
            } else {
                this.selected[ id ] = name
            }
        }
    }
}
</script>
