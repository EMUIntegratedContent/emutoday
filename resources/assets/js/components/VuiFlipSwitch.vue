<template>
  <div class="vuiflipswitch">
    <input
        :id="switchId"
        type="checkbox"
        name="vuiflipswitch"
        class="vuiflipswitch-checkbox"
        :checked="checked"
        :readonly="readonly"
        :disabled="disabled"
        @change="chkToggle"
    >
    <label :for="switchId" class="vuiflipswitch-label" :class="checked ? 'checked' : ''">
      <span class="vuiflipswitch-inner"></span>
      <span class="vuiflipswitch-switch"></span>
    </label>
  </div>
</template>
<script>
export default {
  props: {
    modelValue: [Number, String],
    disabled: {
      type: Boolean,
      default: false
    },
    switchId: {
      type: String,
      required: true
    },
    readonly: {
      type: Boolean,
      default: false
    }
  },
  created() {
    this.checked = parseInt(JSON.parse(JSON.stringify(this.modelValue)))
  },
  data () {
    return {
      checked: false
    }
  },
  methods: {
    chkToggle () {
      this.checked = this.checked ? 0 : 1
      this.$emit('update:modelValue', this.checked)
    }
  },
  watch: {
    modelValue () {
      this.checked = parseInt(JSON.parse(JSON.stringify(this.modelValue)))
    }
  }
}
</script>
<style>
.vuiflipswitch {
  position: relative;
  width: 36px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}

.vuiflipswitch-checkbox {
  display: none;
}

.vuiflipswitch-label {
  display: block;
  overflow: hidden;
  cursor: pointer;
  border: 1px solid #666666;
  border-radius: 4px;
}

.vuiflipswitch-inner {
  display: block;
  width: 200%;
  margin-left: -100%;
  transition: margin 0.3s ease-in 0s;
}

.vuiflipswitch-inner:before, .vuiflipswitch-inner:after {
  display: block;
  float: left;
  width: 50%;
  height: 20px;
  padding: 0;
  line-height: 20px;
  font-size: 14px;
  color: white;
  font-family: Trebuchet, Arial, sans-serif;
  font-weight: bold;
  box-sizing: border-box;
}

.vuiflipswitch-inner:before {
  content: "Y";
  padding-left: 5px;
  background-color: #EEEEEE;
  color: #605CA8;
}

.vuiflipswitch-inner:after {
  content: "N";
  padding-right: 5px;
  background-color: #EEEEEE;
  color: #666666;
  text-align: right;
}

.vuiflipswitch-switch {
  display: block;
  width: 16px;
  margin: 0;
  background: #666666;
  position: absolute;
  top: 0;
  bottom: 0;
  /*right: 16px;*/
  /*border: 2px solid #666666; */
  border-radius: 4px;
  transition: all 0.3s ease-in 0s;
}

.vuiflipswitch-checkbox:checked + .vuiflipswitch-label .vuiflipswitch-inner {
  margin-left: 0;
}

.vuiflipswitch-checkbox:checked + .vuiflipswitch-label .vuiflipswitch-switch {
  right: 0px;
  background-color: #605CA8;
}

select.form-control {
  height: 22px;
  border: 1px solid #666666;
}


h6 {
  margin-top: 0;
  margin-bottom: 0;
}

.form-group label {
  margin-bottom: 0;
}

.box.box-solid.box-default {
  border: 1px solid #666666;
}
</style>
