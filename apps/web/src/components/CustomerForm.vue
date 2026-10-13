<template>
  <q-form class="q-gutter-y-md" @submit="$emit('submit')">
    <q-toggle
      v-model="customer.enabled"
      :label="`Cliente ${customer.enabled ? 'ativo' : 'inativo'}`"
    />

    <q-input
      v-model="customer.name"
      outlined
      stack-label
      required
      label="Nome"
    />

    <q-input
      v-model="customer.email"
      outlined
      stack-label
      required
      type="email"
      label="E-mail"
    />

    <q-input
      v-model="customer.phone"
      outlined
      stack-label
      label="Telefone"
    />

    <div class="full-width bg-grey-1 q-py-md">
      <q-btn-group spread flat>
        <q-btn
          flat
          no-caps
          type="submit"
          label="Salvar"
          icon="save"
          color="positive"
          :loading="customer.saving"
        />
      </q-btn-group>
    </div>
  </q-form>
</template>

<script setup>
const customer = defineModel({
  default: () => ({
    id: null,
    enabled: true,
    name: '',
    email: '',
    phone: '',
    saving: false,
  }),
})

defineEmits(['submit'])
</script>