<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected_length === 0">{{ $t('tags.tags_list') }}</div>
            <div class="header-badges" v-else>
                <div class="badge" v-for="(name, id) in selected" :key="id">
                    <div class="badge-wrapper">
                        <div class="badge-label">{{ name }}</div>
                        <div class="badge-delete">
                            <span class="material-icons" @click.stop="deleteSelection(id)">close</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="menu-option-add" @click="visibleAddTag()">{{ $t('tags.add_new_tag') }}</div>

            <template v-if="tags.length > 0">
                <div class="menu-search" v-if="tags.length > 4">
                    <input type="search" v-model="search" class="input w-100" :placeholder="$t('search')" />
                </div>

                <div class="menu-list">
                    <template v-for="t in tags">
                        <div class="menu-list-selectable-item" :key="t.id" v-if="!search || regexSearch(t.name)">
                            <div class="selectable-item-checkbox">
                                <input type="checkbox" v-model="$parent.company.tags" :value="t.id"
                                    @change="updateSelection(t.id, t.name)" :id="'update-tag-'+t.id" />
                            </div>

                            <label class="selectable-item-label" :for="'update-tag-'+t.id">{{ t.name }}</label>
                        </div>
                    </template>
                </div>
            </template>

            <div class="menu-empty" v-else>{{ $t('tags.no_tag_found') }}</div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    props: [ 'tags' ],
    data: function () {
        return {
            dropdownId: 'dropdown-update-company-tags',

            selected: {},
            search: null
        }
    },
    created: function () {
        EventBus.on('add_new_tag', (tag) => this.selected[ tag.id ] = tag.name)
    },
    computed: {
        selected_length: function () { return Object.keys(this.selected).length }
    },
    methods: {
        visibleAddTag: function () {
            this.displayDropdown = false

            EventBus.emit('visible_add_tag')
        },
        deleteSelection: function (id) {
            delete this.selected[ id ]

            this.$parent.company.tags = this.$parent.company.tags.filter((t) => t != id)
        },
        updateSelection: function (id, name) {
            if (id in this.selected) {
                delete this.selected[ id ]
            } else {
                this.selected[ id ] = name
            }
        },
        refreshTags: function () {
            this.selected = {}

            for (let t of this.$parent.company.tags) {
                for (let ta of this.tags) {
                    if (ta.id === t) {
                        this.selected[ ta.id ] = ta.name

                        break
                    }
                }
            }
        }
    }
}
</script>
