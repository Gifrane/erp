<template>
    <div class="configure-tab">
        <div class="configure-tab-name">
            <label for="tab-block-name">Nom</label>
            <input type="text" class="input w-100" id="tab-block-name" v-model="configuration.name" />
        </div>

        <div class="divider"></div>

        <div class="configure-tab-type">
            <div class="tab-type-item" :class="{ active: configuration.type === 'calculated_datas' }" @click="selectType('calculated_datas')">
                <img src="/" alt="Calculated datas" />
            </div>
            <div class="tab-type-item" :class="{ active: configuration.type === 'bars' }" @click="selectType('bars')">
                <img src="/" alt="Bars" />
            </div>
            <div class="tab-type-item" :class="{ active: configuration.type === 'doughnut' }" @click="selectType('doughnut')">
                <img src="/" alt="Doughnut" />
            </div>
            <div class="tab-type-item" :class="{ active: configuration.type === 'lines' }" @click="selectType('lines')">
                <img src="/" alt="Lines" />
            </div>
        </div>

        <div class="divider"></div>

        <!-- Configure datas -->

        <div class="divider"></div>

        <div class="configure-tab-actions">
            <button class="btn btn-success" @click="add()">
                <icon-add :height="22" :width="22" :middle="true" />
                Add
            </button>
        </div>
    </div>
</template>

<script>
import IconAdd from '../../../icons/IconAdd.vue'

export default {
    components: { IconAdd },
    props: [ 'config' ],
    data: function () {
        return {
            configuration: {},
        }
    },
    created: function () {
        this.configuration = this.config
    },
    methods: {
        selectType: function (block_type) {
            this.configuration.type = block_type
        },
        add: function () {
            EventBus.emit('global_confirm_dialog', {
                message: 'Are you sure you want to proceed ?',
                header: 'Confirmation',
                icon_type: 'material-icons-outlined',
                icon: 'notification_important',
                acceptLabel: 'Yes',
                rejectLabel: 'No',
                accept: () => {
                    this.$toast.success('La configuration a été ajoutée.')

                    this.$parent.config = { name: null, type: 'calculated_datas' }
                    this.$parent.visible_pane = false
                },
                reject: () => {}
            })
        },
    }
}
</script>