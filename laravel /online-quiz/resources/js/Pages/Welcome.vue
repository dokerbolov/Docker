<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="bg-light text-dark min-vh-100 d-flex flex-column">

        <!-- HEADER / NAV -->
        <header class="container py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Laravel App</h4>

                <div v-if="canLogin">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="btn btn-outline-dark me-2"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="btn btn-outline-primary me-2"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="btn btn-primary"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="container flex-grow-1 py-5">
            <div class="row g-4">

                <!-- Documentation Card -->
                <div class="col-md-6">
                    <a href="https://laravel.com/docs" class="text-decoration-none text-dark">
                        <div class="card shadow-sm h-100">
                            <img
                                src="https://laravel.com/assets/img/welcome/docs-light.svg"
                                class="card-img-top"
                                alt="Docs"
                            />
                            <div class="card-body">
                                <h5 class="card-title">Documentation</h5>
                                <p class="card-text">
                                    Laravel has wonderful documentation covering every aspect of the framework.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Laracasts -->
                <div class="col-md-6">
                    <a href="https://laracasts.com" class="text-decoration-none text-dark">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">Laracasts</h5>
                                <p class="card-text">
                                    Thousands of video tutorials on Laravel, PHP, and JavaScript.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Laravel News -->
                <div class="col-md-6">
                    <a href="https://laravel-news.com" class="text-decoration-none text-dark">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">Laravel News</h5>
                                <p class="card-text">
                                    Latest news, tutorials, and ecosystem updates.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Ecosystem -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Ecosystem</h5>
                            <p class="card-text">
                                Tools like Forge, Vapor, Nova, and open-source packages help scale your apps.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- FOOTER -->
        <footer class="text-center py-4 border-top">
            <small>
                Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
            </small>
        </footer>
    </div>
</template>
