<template>
  <Head title="Dashboard"/>
  <AuthenticatedLayout>
    <template #header>
      Task List
    </template>
    <!-- TASK FORM -->
    <form @submit.prevent="submit">
      <div class="row">
        <div class="col-12 col-md-5">
          <input type="text" class="form-control" placeholder="Task Name" v-model="form.task_name">
          <div v-if="form.errors.task_name" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.task_name }}</div>
        </div>
        <div class="col-12 col-md-5 mt-2 mt-md-0">
          <select class="form-select" v-model="form.task_category">
            <option disabled>Please select one Category</option>
            <option v-for="category in categorys" :key="category.id" :value="category.id">{{category.name}}</option>
          </select>
          <div v-if="form.errors.task_category" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.task_category }}</div>

        </div>
        <div class="col-12 col-md-2 mt-2 mt-md-0">
          <button type="submit" class="btn btn-primary btn-block">Create Task</button>
        </div>
      </div>
    </form>
    <!-- TASKS CREATED -->
    <div class="table-responsive mt-5">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#ID</th>
            <th scope="col">Task Name</th>
            <th scope="col">Category</th>
            <th scope="col">Done</th>
            <th scope="col">User</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in tasks.data" :key="task.id">
            <th scope="row">{{task.id}}</th>
            <td>{{task.name}}</td>
            <td>{{task.category.name}}</td>
            <td><input type="checkbox" class="form-check-input" :checked="task.done" @click="taskComplete(task)"></td>
            <td>{{task.user.name}}</td>
            <td>{{task.created_at.split('T')[0] }}</td>
            <td>
              <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#taskModal" @click="modalTask(task)">Edit</button>
              <button type="button" class="btn btn-danger" @click="deleteTask(task)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- MODAL EDIT TASK -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Task / {{modalFormTask.task_name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitChange">
              <div class="row">
                <div class="col-12 mb-3">
                  <input type="text" class="form-control" :placeholder="modalFormTask.task_name" v-model="modalFormTask.task_name">
                  <div v-if="modalFormTask.errors.task_name" class="text-white bg-danger p-2 rounded my-2">{{ modalFormTask.errors.task_name }}</div>
                </div>
                <div class="col-12 mb-3">
                  <select class="form-select" v-model="modalFormTask.task_category">
                    <option selected>Please select one Category</option>
                    <option v-for="category in categorys" :key="category.id" :value="category.id" :selected="modalFormTask.task_category === category.name">
                      {{ category.name }}
                    </option>
                  </select>
                  <div v-if="modalFormTask.errors.task_category" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.task_category }}</div>
                </div>
              </div>
              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal" id="closeModal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- TASK LIST -->
    <Pagination :links="tasks.links"></Pagination>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'

const props = defineProps(['categorys','tasks']);

const modalTask = function(task){
  modalFormTask.task_id = task.id
  modalFormTask.task_name = task.name
  modalFormTask.task_category = task.category.name
}

const form = useForm({
  task_name: null,
  task_category: null,
});

const modalFormTask = useForm({
  task_name: null,
  task_category: null,
  task_id: null,
});


function submit(task){
  axios.post(route('task.create', form))
    .then(res => {
      console.log(res)
      router.reload({ only: ['tasks'] });
      resetForms(); 
    })
    .catch(error => {
      console.error(error);
    });
}

function submitChange(){
  modalFormTask.put('update_task', {
    onSuccess: () => {
      document.getElementById('closeModal').click();
      router.reload();
    },
  });
}

function deleteTask(task){
  axios.post(route('task.delete', task))
    .then(res => {
      console.log(res)
      router.get('dashboard');
    })
    .catch(error => {
      console.error(error);
    });
}

function taskComplete(task){
  axios.put(route('task.complete',task))
  .then(res => {
     console.log(res)
  })
}

function resetForms (){
  form.task_name = null
  form.task_category = null
  modalFormTask.task_name = null,
  modalFormTask.task_category = null,
  modalFormTask.task_id = null
}

</script>


