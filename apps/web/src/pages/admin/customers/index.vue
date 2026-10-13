<template>
  <q-page padding>
    <q-list separator>
      <q-item class="row">
        <q-item-section avatar>
          <q-avatar icon="people" />
        </q-item-section>
        <q-item-section>
          <q-input
            v-model="search"
            stack-label
            :label="`Clientes (${paging?.total ?? '..'})`"
            placeholder="Pesquisar"
          />
        </q-item-section>
        <q-item-section side>
          <q-btn
            round
            flat
            color="secondary"
            icon="add"
            to="/admin/customers/create"
          />
        </q-item-section>
      </q-item>

      <q-item v-for="customer in paging.data" :key="customer.id">
        <q-item-section>
          <q-item-label>{{ customer.name }}</q-item-label>
          <q-item-label caption>{{ customer.email }}</q-item-label>
        </q-item-section>

        <q-item-section side>
          <q-btn-group rounded flat>
            <q-btn
              flat
              color="primary"
              icon="edit"
              :to="`/admin/customers/${customer.id}`"
            />
            <q-btn
              flat
              color="negative"
              icon="delete"
              @click="confirmToDelete(customer)"
            />
          </q-btn-group>
        </q-item-section>
      </q-item>

      <q-item>
        <q-item-section class="flex flex-center">
          <q-pagination
            v-model="paging.current_page"
            :max="paging.last_page"
            @update:model-value="fetchCustomers"
          />
        </q-item-section>
      </q-item>
    </q-list>
  </q-page>
</template>

<script setup>
import { Dialog, Notify } from 'quasar'
import { onMounted, ref } from 'vue'
import { deleteCustomer, getCustomers } from './_api'

const search = ref('')
const paging = ref({
  current_page: 1,
  last_page: 1,
  data: [],
})

const fetchCustomers = () => {
  getCustomers({ page: paging.value.current_page }).then((data) => {
    paging.value = data
  })
}

const confirmToDelete = (customer) => {
  Dialog.create({
    message: 'Confirma exclusão do cliente?',
    caption: 'Esta ação não pode ser desfeita',
  }).onOk(() => {
    deleteCustomer(customer.id)
      .then(() => {
        Notify.create('Cliente excluído!')
        fetchCustomers()
      })
      .catch((e) => {
        Notify.create({
          type: 'negative',
          message: 'Falha na operação',
          caption: e?.response?.data?.message ?? 'Analisar logs',
        })
      })
  })
}

onMounted(() => {
  fetchCustomers()
})
</script>