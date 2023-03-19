<template>
    <div class="grid mt-4 ml-2 mr-2">
        <div class="col-12">
            <div class="tab-content p-4">
                <div class="explorer">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            directories: [],
            files: []
        }
    },
    created: function () {
        this.getContent()
    },
    methods: {
        getContent: function () {
            axios.post('/explorer/content', { directory: 'origin' })
                .then((res) => {
                    let data = res.data.data

                    this.directories = data.directories
                    this.files = data.files
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>