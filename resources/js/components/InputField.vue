<template>
  <div>
    <dt v-if="label" class="w-full mb-1 text-sm font-medium text-dark">
      {{ label }}<span v-if="required" class="text-red-500">*</span>
    </dt>
    <input
      :type="type"
      :placeholder="placeholder"
      v-model="model"
      :required="required"
      class="w-full px-4 py-2 text-sm border-0 rounded-lg ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-0 bg-gray-50 text-dark placeholder:text-sm placeholder:text-gray-800"
    />
  </div>
</template>

<script setup>
import { defineProps, defineModel } from 'vue';

const props = defineProps({
  label: String,
  type: {
    type: String,
    default: 'text',
  },
  placeholder: String,
  required: {
    type: Boolean,
    default: false,
  },
});

const model = defineModel();
</script>
