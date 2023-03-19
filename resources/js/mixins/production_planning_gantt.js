import { gantt } from 'dhtmlx-gantt'

export default {
    methods: {
        initGantt: function () {
            gantt.config.xml_date = '%Y-%m-%d'

            gantt.init(this.$refs.gantt)

            if (this.tasks.length > 0) {
                gantt.parse({
                    data: this.tasks
                })
            }

            gantt.locale.labels.section_priority = 'Priority'

            gantt.config.lightbox.sections = [
                { name: "description", height: 70, map_to: "text", type: "textarea", focus: true },
                {
                    name: "priority", height: 22, map_to: "priority", type: "select",
                    options: [
                        { key: 0, label: 'Low' }, { key: 1, label: 'Normal' }, { key: 2, label: 'High' },
                    ]
                },
                { name: "time", height: 72, map_to: "auto", type: "duration" }
            ]

            gantt.plugins({
                fullscreen: true
            })

            gantt.createDataProcessor((entity, action, data, id) => {
                EventBus.emit(`${entity}-updated`, id, action, data);
            })

            gantt.attachEvent('onAfterTaskAdd', (data, data2) => this.eventAddTask(data2))
            gantt.attachEvent('onAfterTaskMove', (data, data2) => this.eventUpdateTask(data2))
            gantt.attachEvent('onAfterTaskUpdate', (data, data2) => this.eventUpdateTask(data2))
        },
        eventAddTask: function (data) {
            axios.post('/production/'+this.productionId+'/planning/add', {
                gantt_id: data.id, parent_gantt_id: (data.parent === 0) ? null : data.parent,
                title: data.text, priority: data.priority,
                started_at: new Date(data.start_date.toString().replace(/\+(.*)$/, '+0000')),
                ended_at: new Date(data.end_date.toString().replace(/\+(.*)$/, '+0000')),
                duration: data.duration
            })
                .then(() => {
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        eventUpdateTask: function (data) {
            axios.post('/production/'+this.productionId+'/planning/update/task/'+data.id, {
                parent_gantt_id: (data.parent === 0) ? null : data.parent, title: data.text, priority: data.priority,
                started_at: new Date(data.start_date.toString().replace(/\+(.*)$/, '+0000')),
                ended_at: new Date(data.end_date.toString().replace(/\+(.*)$/, '+0000')),
                duration: data.duration, progress: Math.ceil(data.progress * 100)
            })
                .then(() => {
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}