export default {
    methods: {
        parentHasClassName: function (e, class_name, in_confirm_dialog = false) {
            let paths = e.composedPath()

            for (let p of paths) {
                if (p.nodeName === 'svg') {
                    if ('className' in p && p.className.animVal.includes(class_name)) {
                        return true
                    }
                } else if ('className' in p && typeof p.className === 'string' && p.className.includes(class_name)) {
                    return true
                } else if (in_confirm_dialog && 'className' in p && typeof p.className === 'string' && p.className.includes('confirm-wrapper')) {
                    return true
                }
            }

            return false
        }
    }
}