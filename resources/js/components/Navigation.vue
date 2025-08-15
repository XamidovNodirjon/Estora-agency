<template>
    <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
        <div class="font-bold">MyApp</div>
        <ul class="flex space-x-4">
            <li><a href="/" class="hover:underline">Home</a></li>
            <li><a href="/about" class="hover:underline">About</a></li>
            <li><a href="{{ route('login.index') }}" class="hover:underline">Login</a></li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'Navigation',
};
</script>

<style scoped>
/* Agar o'ziga xos CSS kerak bo'lsa shu yerga yoziladi */
</style>
