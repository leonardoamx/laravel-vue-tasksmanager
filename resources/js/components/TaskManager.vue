<template>
    <div>
        <h1>Task Manager</h1>
        <form @submit.prevent="addTask">
            <input v-model="newTask.title" placeholder="Task Title" required />
            <textarea v-model="newTask.description" placeholder="Task Description"></textarea>
            <button type="submit">Add Task</button>
        </form>

        <ul>
            <li v-for="task in tasks" :key="task.id">
            <div>
                <strong>{{ task.title }}</strong>
                <p>{{ task.description }}</p>
                <button @click="editTask(task)">Edit</button>
                <button @click="deleteTask(task.id)">Delete</button>
            </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';


const tasks = ref([]);
const newTask = ref({
    title: '',
    description: ''
});

onMounted(() => {
    fetchTasks();
});

async function fetchTasks() {
    try {
        const response = await axios.get('/api/tasks');
        tasks.value = response.data;
    } catch (error) {
        console.error('Error fetching tasks:', error);
    }
}

async function addTask() {
    try {
        const response = await axios.post('/api/tasks', newTask.value);
        tasks.value.push(response.data);
        newTask.value.title = '';
        newTask.value.description = '';
    } catch (error) {
        console.error('Error adding task:', error);
    }
}

async function editTask(task) {
    const updatedTitle = prompt('Edit Title', task.title);
    const updatedDescription = prompt('Edit Description', task.description);
    if (updatedTitle && updatedDescription) {
        try {
            const response = await axios.put(`/api/tasks/${task.id}`, {
                title: updatedTitle,
                description: updatedDescription
            });
            const index = tasks.value.findIndex(t => t.id === task.id);
            tasks.value[index] = response.data;
        } catch (error) {
            console.error('Error editing task:', error);
        }
    }
}

async function deleteTask (id) {
    try {
        await axios.delete(`/api/tasks/${id}`);
        tasks.value = tasks.value.filter(task => task.id !== id);
    } catch (error) {
        console.error('Error deleting task:', error);
    }
}
</script>
