<template>
    <div class="sidebar-wrapper" v-if="$parent.visibleAdd">
        <div class="sidebar" role="complementary" v-click-outside="outside">
            <div class="sidebar-header">
                <div class="sh-title">{{ $t('pages.accounting_billings.add_billing') }}</div>
                <div class="sh-close"><span class="material-icons">close</span></div>
            </div>

            <div class="sidebar-body">
                <div class="grid mt-3">
                    <div class="col-4">{{ $t('pages.accounting_billings.billing_type') }}</div>
                    <div class="col-8"><dropdown-direction /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('title') }}</div>
                    <div class="col-8"><input type="text" v-model="add.title" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.accounting_billings.tax_free_amount') }}</div>
                    <div class="col-8"><input type="number" v-model="add.amount_ht" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.accounting_billings.amount_including_taxes') }}</div>
                    <div class="col-8"><input type="number" v-model="add.amount_ttc" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.accounting_billings.emitted_at') }}</div>
                    <div class="col-8"><Calendar v-model="add.emitted_at" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.accounting_billings.settled_at') }}</div>
                    <div class="col-8"><Calendar v-model="add.completed_at" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('step') }}</div>
                    <div class="col-8"><dropdown-step /></div>
                </div>

                <div class="grid mt-2" v-if="add.type === 'expense'">
                    <div class="col-4">{{ $t('pages.accounting_billings.receiver') }}</div>
                    <div class="col-8">
                        <input type="text" v-model="add.receiver.string" class="input w-100" />
                        <!-- Bouton de menu pour permettre d'utiliser une entité (CRM contact, CRM compagnie) -->
                    </div>
                </div>
                <div class="grid mt-2" v-else-if="add.type === 'income'">
                    <div class="col-4">{{ $t('pages.accounting_billings.emitter') }}</div>
                    <div class="col-8">
                        <input type="text" v-model="add.emitter.string" class="input w-100" />
                        <!-- Bouton de menu pour permettre d'utiliser une entité (CRM contact, CRM compagnie) -->
                    </div>
                </div>

                <button class="btn btn-success" @click="addBilling()">
                    <span class="material-icons">add</span>
                    <span>{{ $t('add') }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import Calendar from '../../../ui/Calendar.vue'

import DropdownDirection from './add_billing/DropdownDirection.vue'
import DropdownStep from './add_billing/DropdownStep.vue'

export default {
    components: { Calendar, DropdownDirection, DropdownStep },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            add: {
                direction: null, title: null, amount_ht: 0, amount_ttc: 0, emitted_at: null, completed_at: null,
                emitter: { string: null, entity_id: null, entity_type: null },
                receiver: { string: null, entity_id: null, entity_type: null }
            }
        }
    },
    methods: {
        addBilling: function () {
            axios.post('/accounting/billings/add', this.add)
                .then((res) => {
                    this.$router.push('/accounting/billings/'+res.data.data)
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        outside: function () {
            this.$parent.visibleAdd = false
        }
    }
}
</script>
