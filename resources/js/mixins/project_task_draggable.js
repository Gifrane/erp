export default {
    data: function () {
        return {
            drag: { list: null, task: null }
        }
    },
    methods: {
        startDragTask: function (event) {
            this.drag.task = event.item.id.replace('project_task_', '')

            for (let p in event.path) {
                let path = event.path[p].id

                if (path.startsWith('project_list_')) {
                    this.drag.list = path.replace('project_list_', '')

                    break
                }
            }
        },
        endDragTask: function (event) {
            var to = event.to
            var listId = null

            while (to) {
                if (typeof to.parentNode.id !== 'undefined' && to.parentNode.id.startsWith('project_list_')) {
                    listId = to.parentNode.id.replace('project_list_', '')

                    break
                }

                to = to.parentNode
            }

            EventBus.emit('update_order_task', { task: this.drag.task, oldList: this.drag.list, newList: listId })
        }
    }
}