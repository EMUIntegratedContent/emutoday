<template>
    <label class="btn btn-default btn-xs">
   <input type="radio" name="options" id="{{$index}}" autocomplete="off"><span class="item-type-icon" :class="typeIcon"></span>
 </label>

    <!-- <button type="button" class="btn btn-default"><span class="item-type-icon" :class="typeIcon"></span></button> -->
</template>

<script>
    export default {

      props: ['item'],

        created() {

        },
        ready() {
            // this.$emit('set-filter', this.item.shortname);
        },
        computed: {
            typeIcon: function() {
                switch (this.item.shortname) {
                    case 'emutoday':
                    case 'story':
                    faicon = 'fa-file-image-o'
                    break
                    case 'news':
                    faicon = 'fa-file-text-o'
                    break
                    case 'student':
                    faicon = 'fa-graduation-cap'
                    break
                    case 'external':
                    faicon = 'fa-file-o'
                    break
                    case 'article':
                    faicon = 'fa-newspaper-o'
                    break
                    default:
                    faicon = 'fa-file-o'
                    break
                }

                return 'fa '+ faicon + ' fa-fw'

            },

        }
      };
</script>

<style>
.item-type-icon {
    color: #1B1B1B;
    /*position:absolute;
    top: 5px;
    left: 5px;*/

}
</style>
