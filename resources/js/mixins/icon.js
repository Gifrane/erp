export default {
    props: [ 'height', 'middle', 'pointer', 'width' ],
    computed: {
        style: function () {
            var style = 'height: '+this.height+'; width: '+this.width+';'

            if (typeof this.middle === 'boolean' && this.middle) {
                style += ' vertical-align: middle;'
            }

            if (typeof this.pointer === 'boolean' && this.pointer) {
                style += ' cursor: pointer;'
            }

            return style
        }
    }
}