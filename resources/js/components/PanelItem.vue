<template>
  <div :class="elementSize">
    <field-wrapper :stacked="field.stacked">
      <div :class="field.stacked ? 'md:pt-6 md:w-full' : 'md:py-4 md:w-1/4'">
        <div class="">
          <slot>
            <h4 class="font-normal text-80">{{ label }}</h4>
          </slot>
        </div>
      </div>
      <div class="py-4 break-words" :class="fieldClasses">
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
    </field-wrapper>
  </div>
</template>

<script>
export default {
  props: {
    field: {
      type: Object,
      required: true,
    },
    fieldName: {
      type: String,
      default: "",
    },
  },
  mounted() {
    // If field has a size, this allows to use flex on card
    if (this.hasSize & this.$parent.$parent.$parent.selectedTab === undefined) {
      this.$parent.$parent.$el.classList.add("flex-dom");
      this.$parent.$parent.$el.classList.add("flex-wrap");
      this.$parent.$parent.$el.classList.add("flex");
    }

    //Use for eminiarts/nova-tabs package
    if (
      this.hasSize &
      (this.$parent.$parent.$parent.selectedTab !== undefined)
    ) {
       this.$el.classList.add("inline-block");
    }

    if (this.getRemoveBottomBorder === true) {
      this.$el.children[0].classList.add("remove-bottom-border");
    } else if (this.getRemoveBottomBorder === false) {
      this.$el.children[0].classList.remove("remove-bottom-border");
    }
  },
  computed: {
    label() {
      return this.fieldName || this.field.name;
    },

    fieldValue() {
      if (
        this.field.value === "" ||
        this.field.value === null ||
        this.field.value === undefined
      ) {
        return false;
      }

      return String(this.field.value);
    },

    shouldDisplayAsHtml() {
      return this.field.asHtml;
    },

    fieldClasses() {
      return this.fullWidthContent
        ? this.field.stacked
          ? "w-full"
          : "w-4/5"
        : this.hasSize
        ? "w-full"
        : "w-3/4";
    },

    /**
     * Return the size that should be used for the field container.
     */
    elementSize() {
      return this.field.size || "w-full";
    },

    /**
     * Return if the field has a size
     */
    hasSize() {
      return this.field.size !== undefined;
    },

    getRemoveBottomBorder() {
      return this.field.removeBottomBorder || null;
    },
  },
};
</script>
