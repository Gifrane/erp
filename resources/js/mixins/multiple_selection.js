export default {
    data: function () {
        return {
            selected: [],
            selected_all: false,
        }
    },
    methods: {
        selectedAllAction: function () {
            if (this.selected_all) {
                this.selected = this[ this.multiple_selection_data.var ]
                    .map((p) => p[ this.multiple_selection_data.key ])
            } else {
                this.selected = []
            }
        },
        selectedAction: function () {
            this.selected_all = (this.selected.length === this[this.multiple_selection_data.var].length)
        }
    }
}