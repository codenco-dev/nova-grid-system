<template>
  <div
    class="flex flex-col md:flex-row -mx-6 px-6 py-2 md:py-0 space-y-2 md:space-y-0"
    :class="{ 'border-t border-gray-100 dark:border-gray-700': index !== 0 }"
    :dusk="field.attribute"
  >
    <div class="md:w-1/4 md:py-3">
      <slot>
        <h4 class="font-bold md:font-normal">
          <span>{{ label }}</span>
        </h4>
      </slot>
    </div>
    <div class="md:w-3/4 md:py-3 break-words">
      <slot name="value">
        <p v-if="fieldValue && !shouldDisplayAsHtml" class="text-90">
          {{ fieldValue }}
        </p>
        <div
          v-else-if="fieldValue && shouldDisplayAsHtml"
          v-html="field.value"
        ></div>
        <p v-else>&mdash;</p>
      </slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    index: {
      type: Number,
      required: true,
    },

    field: {
      type: Object,
      required: true,
    },

    fieldName: {
      type: String,
      default: '',
    },
  },

  computed: {
    label() {
      return this.fieldName || this.field.name
    },

    fieldValue() {
      if (
        this.field.value === '' ||
        this.field.value === null ||
        this.field.value === undefined
      ) {
        return false
      }

      return String(this.field.value)
    },

    shouldDisplayAsHtml() {
      return this.field.asHtml
    },
  },
}
</script>
