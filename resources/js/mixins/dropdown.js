export default {
    data: function () {
        return {
            displayDropdown: false
        }
    },
    methods: {
        regexSearch: function (entity) {
            return new RegExp(this.search, 'i').test(entity)
        },
        outside: function (e) {
            let path = e.composedPath()
            var hide = true

            for (let p in path) {
                if ('id' in path[p] && path[p].id === this.dropdownId) {
                    hide = false

                    break
                }
            }

            if (hide) {
                this.hideDropdown()
            }
        },
        displayDropdownAction: function () {
            this.displayDropdown = !this.displayDropdown
        },
        hideDropdown: function () {
            this.displayDropdown = false
        }
    }
}