<template>
    <div class="image-input image-input-outline image-input-changed" id="kt_user_add_avatar">
        <div ref="previewImage" class="image-input-wrapper" :style="'background-image:url(\''+imageUrl+'\')'"></div>
        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change"
               data-toggle="tooltip" title="" data-original-title="Change avatar">
            <i class="fa fa-pen icon-sm text-muted"></i>
            <input type="file" @change="imageSelected($event)" ref="rImage" name="image" accept=".png, .jpg, .jpeg">
        </label>
        <span v-if="isImageSelected" @click="deleteSelectedImage()"
              class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel"
              data-toggle="tooltip" title="" data-original-title="Cancel avatar">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
    </div>
</template>

<script>
export default {
    name: "ImagePicker",
    data() {
        return {
            isImageSelected: false,
            image: '',
            imageUrl: '',
        };
    },
    methods: {
        imageSelected(event) {
            const file = event.target.files[0];
            this.image = file
            this.imageUrl = URL.createObjectURL(file)
            this.isImageSelected = true
        },
        deleteSelectedImage() {
            this.image = ''
            this.imageUrl = ''
            this.isImageSelected = false
        }
    },
}
</script>

<style scoped>

</style>
