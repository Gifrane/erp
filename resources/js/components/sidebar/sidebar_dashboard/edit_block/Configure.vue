<template>
    <div class="configure-tab">
        <div class="configure-tab-name">
            <label for="tab-block-name">Nom</label>
            <input type="text" class="input w-100" id="tab-block-name" />
        </div>

        <div class="divider"></div>

        <div class="configure-tab-type">
            <div class="tab-type-item" :class="{ active: config.type === 'calculated_datas' }" @click="selectType('calculated_datas')">
                <img src="/" alt="Calculated datas" />
            </div>
            <div class="tab-type-item" :class="{ active: config.type === 'bars' }" @click="selectType('bars')">
                <img src="/" alt="Bars" />
            </div>
            <div class="tab-type-item" :class="{ active: config.type === 'doughnut' }" @click="selectType('doughnut')">
                <img src="/" alt="Doughnut" />
            </div>
            <div class="tab-type-item" :class="{ active: config.type === 'lines' }" @click="selectType('lines')">
                <img src="/" alt="Lines" />
            </div>
        </div>

        <div class="divider"></div>

        <!-- Configure datas -->

        <div class="divider"></div>

        <div class="configure-tab-actions">
            <button class="btn btn-success" @click="save()">
                <icon-save :height="22" :width="22" :middle="true" />
                Save
            </button>

            <button class="btn btn-danger" @click="destroy()">
                <icon-delete :height="22" :width="22" :middle="true" />
                Supprimer
            </button>
        </div>
    </div>
</template>

<script>
export default {
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
        save: function () {
            EventBus.emit('global_confirm_dialog', {
                message: 'Are you sure you want to proceed ?',
                header: 'Confirmation',
                icon_type: 'material-icons-outlined',
                icon: 'notification_important',
                acceptLabel: 'Yes',
                rejectLabel: 'No',
                accept: () => {
                    this.$toast.success('La configuration a été sauvegardée.')

                    this.$parent.config = { name: null }
                    this.$parent.visible_pane = false
                },
                reject: () => {}
            })
        },
        destroy: function () {
            EventBus.emit('global_confirm_dialog', {
                message: 'Are you sure you want to proceed ?',
                header: 'Confirmation',
                icon_type: 'material-icons-outlined',
                icon: 'notification_important',
                acceptLabel: 'Yes',
                rejectLabel: 'No',
                accept: () => {
                    this.$toast.success('La configuration a été supprimée.')

                    this.$parent.config = { name: null }
                    this.$parent.visible_pane = false
                },
                reject: () => {}
            })
        }
    }
}
</script>