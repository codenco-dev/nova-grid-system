<template>
  <div :class="elementSize">
    <field-wrapper :stacked="field.stacked" v-if="field.visible">
      <div class="px-8" :class="field.stacked ? 'pt-6 w-full' : 'py-6 w-1/5'">
        <slot>
          <form-label
            :label-for="field.attribute"
            :class="{ 'mb-2': showHelpText && field.helpText }"
          >
            {{ fieldLabel }}

            <span v-if="field.required" class="text-danger text-sm">{{
              __("*")
            }}</span>
          </form-label>
        </slot>
      </div>
      <div class="py-6 px-8" :class="fieldClasses">
        <slot name="field" />

        <help-text
          class="error-text mt-2 text-danger"
          v-if="showErrors && hasError"
        >
          {{ firstError }}
        </help-text>

        <help-text class="help-text mt-2" v-if="showHelpText">
          {{ field.helpText }}
        </help-text>
      </div>
    </field-wrapper>
  </div>
</template>

<script>
import { HandlesValidationErrors, Errors } from "laravel-nova";

export default {
  mixins: [HandlesValidationErrors],

  props: {
    field: { type: Object, required: true },
    fieldName: { type: String },
    showHelpText: { type: Boolean, default: true },
    showErrors: { type: Boolean, default: true },
    fullWidthContent: { type: Boolean, default: false },
  },

  mounted() {
    if (!this.hasSize) {
      
      this.$el.parentElement.classList.add("w-full");
    }


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
    /**
     * Return the label that should be used for the field.
     */
    fieldLabel() {
      // If the field name is purposefully an empty string, then let's show it as such
      if (this.fieldName === "") {
        return "";
      }

      return this.fieldName || this.field.name || this.field.singularLabel;
    },

    /**
     * Return the classes that should be used for the field content.
     */
    fieldClasses() {
      return this.fullWidthContent
        ? this.field.stacked
          ? "w-full"
          : "w-4/5"
        : this.hasSize
        ? "w-full"
        : "w-1/2";
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

    /**
     * Return if we must to remove or not the bottom border field
     */
    getRemoveBottomBorder() {
      return this.field.removeBottomBorder || null;
    },
  },
};
</script>
