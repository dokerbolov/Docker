<template>
    <div class="modal">
        <div class="modal-content">
            <h3>Result Details</h3>
            <p>ID: {{ result.id }}</p>
            <p>Score: {{ result.score }}</p>

            <button class="btn btn-secondary"  @click="$emit('close')">Close</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ResultModal",
    props: {
        result: {
            type: Object,
            required: true
        }
    },
    created() {
        console.log('hello');
    }
}
</script>

<style scoped>
.modal {
    position: fixed;       /* critical */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;         /* make sure it's above everything */
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.5); /* backdrop */
}

.modal-content {
    background: white;
    width: 60%;
    justify-content: center;
    padding: 20px;
    border-radius: 8px;
    z-index: 10000; /* optional, but safe */
}
</style>
